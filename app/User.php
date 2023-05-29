<?php

namespace LANMS;

use Carbon\Carbon;
use IteratorAggregate;
use Webpatser\Uuid\Uuid;
use LANMS\StripeCustomer;
use Dialect\Gdpr\Portable;
use Illuminate\Support\Str;
use Dialect\Gdpr\Anonymizable;
use Spatie\Searchable\Searchable;
use Laravel\Passport\HasApiTokens;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Roles\EloquentRole;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Cartalyst\Sentinel\Roles\RoleInterface;

use Cartalyst\Sentinel\Users\UserInterface;
use Spatie\Activitylog\Traits\LogsActivity;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Roles\RoleableInterface;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Stripe\Exception\NotFoundException;
use Cartalyst\Sentinel\Reminders\EloquentReminder;
use Cartalyst\Sentinel\Throttling\EloquentThrottle;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cartalyst\Sentinel\Permissions\PermissibleTrait;
use Cartalyst\Sentinel\Activations\EloquentActivation;
use Cartalyst\Sentinel\Permissions\PermissibleInterface;
use Cartalyst\Sentinel\Permissions\PermissionsInterface;
use Cartalyst\Sentinel\Persistences\EloquentPersistence;
use Cartalyst\Sentinel\Persistences\PersistableInterface;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model implements HasLocalePreference, PermissibleInterface, PersistableInterface, RoleableInterface, UserInterface, Searchable
{
    use SoftDeletes, LogsActivity, Portable, Anonymizable, Notifiable, HasUUID, PermissibleTrait;

    /**
     * The attributes that should be hidden for the downloadable data.
     *
     * @var array
     */
    protected $gdprHidden = [
        'password',
        'permissions',
        'profilepicture',
        'profilepicturesmall',
        'profilecover',
        'isAnonymized',
        'accepted_gdpr',
        'authy_id',
    ];

    protected $primaryKey = 'id';

    /**
     * Using replacement strings.
     */
    protected $gdprAnonymizableFields = [
        'firstname' => 'Anon',
        'lastname' => 'Ymized'
    ];

    /**
    * Using getAnonynomized{column} to return anonymizable data
    */
    public function getAnonynomizedEmail()
    {
        return random_bytes(10);
    }

    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'email',
        'username',
        'lastname',
        'firstname',
        'birthdate',
        'phone',
        'phone_country',
        'phone_verified_at',
        'authy_id',
        'gender',
        'occupation',
        'location',
        'showemail',
        'showname',
        'showonline',
        'language',
        'theme',
        'clothing_size',
        'stripe_customer',
        'about',
        'address_street',
        'address_postalcode',
        'address_city',
        'address_county',
        'address_country',
    ];

    /**
     * {@inheritDoc}
     */
    protected $table = 'users';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'lastname',
        'firstname',
        'permissions',
        'referral',
        'referral_code',
        'last_activity',
        'birthdate',
        'phone',
        'phone_country',
        'phone_verified_at',
        'authy_id',
        'gender',
        'occupation',
        'location',
        'profilepicture',
        'profilepicturesmall',
        'profilecover',
        'showemail',
        'showname',
        'showonline',
        'language',
        'theme',
        'clothing_size',
        'stripe_customer',
        'about',
        'address_street',
        'address_postalcode',
        'address_city',
        'address_county',
        'address_country',
        'accepted_gdpr',
        'isAnonymized'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);

            if (!$model->stripe_customer) {
                $customer = Stripe::customers()->create([
                    'email' => $model->email,
                    'name' => $model->firstname.' '.$model->lastname,
                ]);
                $stripe_customer = $customer['id'];
                $model->stripe_customer = $stripe_customer;
            }
        });

        self::updating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Uuid::generate(4);
            }

            if (env('STRIPE_API_KEY')) {
                $sc = StripeCustomer::where('user_id', $model->id)->first();
                if ($sc && !$model->stripe_customer) {
                    $stripe_customer = $sc->cus;
                    $model->stripe_customer = $stripe_customer;
                    $sc->delete();
                } elseif (!$sc && !$model->stripe_customer) {
                    $customer = Stripe::customers()->create([
                        'email' => $model->email,
                        'name' => $model->firstname.' '.$model->lastname,
                    ]);
                    $stripe_customer = $customer['id'];
                    $model->stripe_customer = $stripe_customer;
                } else {
                    try {
                        Stripe::customers()->update($model->stripe_customer, [
                            'email' => $model->email,
                            'name' => $model->firstname.' '.$model->lastname,
                        ]);
                    } catch (NotFoundException $e) {
                        $customer = Stripe::customers()->create([
                            'email' => $model->email,
                            'name' => $model->firstname.' '.$model->lastname,
                        ]);
                        $stripe_customer = $customer['id'];
                        $model->stripe_customer = $stripe_customer;
                    }
                }
            }
        });
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->language;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function addresses()
    {
        return $this->hasMany('Address', 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany('SeatReservation', 'reservedby_id', 'id');
    }

    public function ownReservations()
    {
        return $this->hasMany('SeatReservation', 'reservedfor_id', 'id');
    }

    public function reservationsThisYear()
    {
        return $this->hasMany('SeatReservation', 'reservedby_id', 'id')->thisYear();
    }

    public function ownReservationsThisYear()
    {
        return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->thisYear();
    }

    public function ownReservationsThisYearDecending()
    {
        return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->thisYearDecending();
    }

    public function reservationsLastYear()
    {
        return $this->hasMany('SeatReservation', 'reservedby_id', 'id')->lastYear();
    }

    public function ownReservationsLastYear()
    {
        return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->lastYear();
    }

    public function ownReservationsLastYearDecending()
    {
        return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->lastYearDecending();
    }

    public function stripecustomer()
    {
        return $this->hasOne('LANMS\StripeCustomer', 'user_id', 'id');
    }

    public function seatpayments()
    {
        return $this->hasMany('LANMS\SeatPayment', 'user_id', 'id');
    }

    public function composignups()
    {
        return $this->hasMany('LANMS\CompoSignUp', 'user_id', 'id');
    }

    public function address()
    {
        return $this->hasOne('Address', 'user_id')->where('main_address', 1);
    }

    public function scopeGetLastActivity($query, $id, $short = false)
    {
        $user       = $query->where('id', '=', $id)->first();
        $time       = $user->last_activity;

        $SECOND     = 1;
        $MINUTE     = 60 * $SECOND;
        $HOUR       = 60 * $MINUTE;
        $DAY        = 24 * $HOUR;
        $MONTH      = 30 * $DAY;
        $before     = time() - strtotime($time);

        if ($before < 0) {
            return "not yet";
        }

        if ($time == '0000-00-00 00:00:00') {
            return "never";
        }

        if ($short) {
            if ($before < 1 * $MINUTE) {
                return ($before <5) ? "just now" : $before . " ago";
            }

            if ($before < 2 * $MINUTE) {
                return "1m ago";
            }

            if ($before < 45 * $MINUTE) {
                return floor($before / 60) . "m ago";
            }

            if ($before < 90 * $MINUTE) {
                return "1h ago";
            }

            if ($before < 24 * $HOUR) {
                return floor($before / 60 / 60). "h ago";
            }

            if ($before < 48 * $HOUR) {
                return "1d ago";
            }

            if ($before < 30 * $DAY) {
                return floor($before / 60 / 60 / 24) . "d ago";
            }

            if ($before < 12 * $MONTH) {
                $months = floor($before / 60 / 60 / 24 / 30);
                return $months <= 1 ? "1mo ago" : $months . "mo ago";
            } else {
                $years = floor($before / 60 / 60 / 24 / 30 / 12);
                return $years <= 1 ? "1y ago" : $years."y ago";
            }
        }

        if ($before < 1 * $MINUTE) {
            return ($before <= 1) ? "just now" : $before . " seconds ago";
        }

        if ($before < 2 * $MINUTE) {
            return "a minute ago";
        }

        if ($before < 45 * $MINUTE) {
            return floor($before / 60) . " minutes ago";
        }

        if ($before < 90 * $MINUTE) {
            return "an hour ago";
        }

        if ($before < 24 * $HOUR) {
            return (floor($before / 60 / 60) == 1 ? 'about an hour' : floor($before / 60 / 60).' hours'). " ago";
        }

        if ($before < 48 * $HOUR) {
            return "yesterday";
        }

        if ($before < 30 * $DAY) {
            return floor($before / 60 / 60 / 24) . " days ago";
        }

        if ($before < 12 * $MONTH) {
            $months = floor($before / 60 / 60 / 24 / 30);
            return $months <= 1 ? "one month ago" : $months . " months ago";
        } else {
            $years = floor($before / 60 / 60 / 24 / 30 / 12);
            return $years <= 1 ? "one year ago" : $years." years ago";
        }
    }

    public function scopeGetOnlineStatus($query, $id)
    {
        $user       = $query->where('id', '=', $id)->first();
        $time       = $user->last_activity;

        $SECOND     = 1;
        $MINUTE     = 60 * $SECOND;
        $before     = time() - strtotime($time);

        if ($time == "0000-00-00 00:00:00") {
            return "offline";
        }

        if ($before < 5 * $MINUTE) {
            return "online";
        } elseif ($before < 10 * $MINUTE) {
            return "idle";
        } else {
            return "offline";
        }
    }

    public function scopeGetUserDateFormat($query)
    {
        if (Sentinel::check()) {
            $user       = $query->where('id', '=', Sentinel::getUser()->id)->first();
            $format     = $user->userdateformat;

            if ($format == null) {
                $format = 'd. M Y';
            }
        } else {
            $format = 'd. M Y';
        }

        return $format;
    }

    public function scopeGetUserTimeFormat($query)
    {
        if (Sentinel::check()) {
            $user = $query->where('id', '=', Sentinel::getUser()->id)->first();
            $format = $user->usertimeformat;

            if ($format == null) {
                $format = 'H:i';
            }
        } else {
            $format = 'H:i';
        }

        return $format;
    }
    
    public function scopeGetFullnameByID($query, $id)
    {
        $user = $query->withTrashed()->where('id', '=', $id)->first();
        if ($user->showname) {
            return $user->firstname . ' ' . $user->lastname;
        } else {
            return $user->firstname;
        }
    }

    public function scopeGetUsernameAndFullnameByID($query, $id)
    {
        $user = $query->withTrashed()->where('id', '=', $id)->first();
        if ($user->showname) {
            return $user->username . ' (' . $user->firstname . ' ' . $user->lastname . ')';
        } else {
            return $user->username . ' (' . $user->firstname . ')';
        }
    }

    public function scopeGetFullnameAndNicknameByID($query, $id)
    {
        $user = $query->withTrashed()->where('id', '=', $id)->first();
        if ($user->showname) {
            return $user->firstname . ' "' . $user->username . '" ' . $user->lastname;
        } else {
            return $user->firstname . ' "' . $user->username . '"';
        }
    }

    public function age()
    {
        return Carbon::parse($this->birthdate)->diff(Carbon::now())->format('%y');
    }

    public function fullname()
    {
        if ($this->showname) {
            return $this->firstname . ' ' . $this->lastname;
        } else {
            return $this->firstname;
        }
    }

    public function scopeActive()
    {
        return $this->orderBy('firstname', 'asc')->whereNotNull('last_activity')->where('isAnonymized', '0')->get();
    }

    public function scopeHasAddress()
    {
        if ($this->address_street && $this->address_postalcode && $this->address_city && $this->address_county && $this->address_county) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeGetGenderIcon($query, $gender)
    {
        switch ($gender) {
            case 'Male':
                return "mars";
            case 'Female':
                return "venus";
            case 'Transgender':
                return "transgender";
            case 'Genderless':
                return "genderless";
            default:
                return "genderless";
        }
    }

    /**
    * Make the model searchable
    **/
    public function getSearchResult(): SearchResult
    {
        $url = route('user-profile', $this->username);
     
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->username,
            $url
         );
    }

    /*
    *
    *
    *
    *
    *
    *
    *
    *
    */

    /**
     * We don't implement Authenticatable, because we don't use passwords or remember tokens,
     * but we need this work-around for a bug with ThrottleRequest.
     *
     * @link https://github.com/laravel/framework/issues/21118
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /*
    *
    *
    *
    *
    *
    *
    *
    *
    */

    /**
     * {@inheritdoc}
     */
    protected $persistableKey = 'user_id';

    /**
     * {@inheritdoc}
     */
    protected $persistableRelationship = 'persistences';

    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = ['email', 'username'];

    /**
     * The Roles model FQCN.
     *
     * @var string
     */
    protected static $rolesModel = EloquentRole::class;

    /**
     * The Persistences model FQCN.
     *
     * @var string
     */
    protected static $persistencesModel = EloquentPersistence::class;

    /**
     * The Activations model FQCN.
     *
     * @var string
     */
    protected static $activationsModel = EloquentActivation::class;

    /**
     * The Reminders model FQCN.
     *
     * @var string
     */
    protected static $remindersModel = EloquentReminder::class;

    /**
     * The Throttling model FQCN.
     *
     * @var string
     */
    protected static $throttlingModel = EloquentThrottle::class;

    /**
     * Returns the activations relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activations(): HasMany
    {
        return $this->hasMany(static::$activationsModel, 'user_id');
    }

    /**
     * Returns the persistences relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persistences(): HasMany
    {
        return $this->hasMany(static::$persistencesModel, 'user_id');
    }

    /**
     * Returns the reminders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(static::$remindersModel, 'user_id');
    }

    /**
     * Returns the roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Returns the throttle relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function throttle(): HasMany
    {
        return $this->hasMany(static::$throttlingModel, 'user_id');
    }

    /**
     * Returns an array of login column names.
     *
     * @return array
     */
    public function getLoginNames(): array
    {
        return $this->loginNames;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): IteratorAggregate
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function inRole($role): bool
    {
        if ($role instanceof RoleInterface) {
            $roleId = $role->getRoleId();
        }

        foreach ($this->roles as $instance) {
            if ($role instanceof RoleInterface) {
                if ($instance->getRoleId() === $roleId) {
                    return true;
                }
            } else {
                if ($instance->getRoleId() == $role || $instance->getRoleSlug() == $role) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function inAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->inRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function generatePersistenceCode(): string
    {
        return Str::random(32);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId(): int
    {
        return $this->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistableId(): string
    {
        return $this->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistableKey(): string
    {
        return $this->persistableKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setPersistableKey(string $key): void
    {
        $this->persistableKey = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistableRelationship(): string
    {
        return $this->persistableRelationship;
    }

    /**
     * {@inheritdoc}
     */
    public function setPersistableRelationship(string $persistableRelationship): void
    {
        $this->persistableRelationship = $persistableRelationship;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLogin(): string
    {
        return $this->getAttribute($this->getUserLoginName());
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLoginName(): string
    {
        return reset($this->loginNames);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPassword(): string
    {
        return $this->password;
    }

    /**
     * Returns the roles model.
     *
     * @return string
     */
    public static function getRolesModel(): string
    {
        return static::$rolesModel;
    }

    /**
     * Sets the roles model.
     *
     * @param string $rolesModel
     *
     * @return void
     */
    public static function setRolesModel(string $rolesModel): void
    {
        static::$rolesModel = $rolesModel;
    }

    /**
     * Returns the persistences model.
     *
     * @return string
     */
    public static function getPersistencesModel()
    {
        return static::$persistencesModel;
    }

    /**
     * Sets the persistences model.
     *
     * @param string $persistencesModel
     *
     * @return void
     */
    public static function setPersistencesModel(string $persistencesModel): void
    {
        static::$persistencesModel = $persistencesModel;
    }

    /**
     * Returns the activations model.
     *
     * @return string
     */
    public static function getActivationsModel(): string
    {
        return static::$activationsModel;
    }

    /**
     * Sets the activations model.
     *
     * @param string $activationsModel
     *
     * @return void
     */
    public static function setActivationsModel(string $activationsModel): void
    {
        static::$activationsModel = $activationsModel;
    }

    /**
     * Returns the reminders model.
     *
     * @return string
     */
    public static function getRemindersModel(): string
    {
        return static::$remindersModel;
    }

    /**
     * Sets the reminders model.
     *
     * @param string $remindersModel
     *
     * @return void
     */
    public static function setRemindersModel(string $remindersModel): void
    {
        static::$remindersModel = $remindersModel;
    }

    /**
     * Returns the throttling model.
     *
     * @return string
     */
    public static function getThrottlingModel(): string
    {
        return static::$throttlingModel;
    }

    /**
     * Sets the throttling model.
     *
     * @param string $throttlingModel
     *
     * @return void
     */
    public static function setThrottlingModel(string $throttlingModel): void
    {
        static::$throttlingModel = $throttlingModel;
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        $isSoftDeletable = property_exists($this, 'forceDeleting');

        $isSoftDeleted = $isSoftDeletable && ! $this->forceDeleting;

        if ($this->exists && ! $isSoftDeleted) {
            $this->activations()->delete();
            $this->persistences()->delete();
            $this->reminders()->delete();
            $this->roles()->detach();
            $this->throttle()->delete();
        }

        return parent::delete();
    }

    /**
     * Dynamically pass missing methods to the user.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $methods = ['hasAccess', 'hasAnyAccess'];

        if (in_array($method, $methods)) {
            $permissions = $this->getPermissionsInstance();

            return call_user_func_array([$permissions, $method], $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Creates a permissions object.
     *
     * @return \Cartalyst\Sentinel\Permissions\PermissionsInterface
     */
    protected function createPermissions(): PermissionsInterface
    {
        $userPermissions = $this->getPermissions();

        $rolePermissions = [];

        foreach ($this->roles as $role) {
            $rolePermissions[] = $role->getPermissions();
        }

        return new static::$permissionsClass($userPermissions, $rolePermissions);
    }
}
