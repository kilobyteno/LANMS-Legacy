<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'address1',
        'address2',
        'postalcode',
        'city',
        'county',
        'country',
        'user_id',
        'main_address'
    ];
    protected $table = 'addresses';

    protected static $logName = 'address';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'address1',
        'address2',
        'postalcode',
        'city',
        'county',
        'country',
        'main_address'
    ];

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }
}
