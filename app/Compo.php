<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Compo extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at', 'start_at', 'last_sign_up_at', 'end_at'];
    protected $table = 'compo';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'page_id',
        'challonge_subdomain',
        'challonge_url',
        'year',
        'author_id',
        'editor_id',
        'start_at',
        'last_sign_up_at',
        'end_at',
        'type',
        'signup_type',
        'signup_size',
        'min_signups',
        'max_signups',
        'prize_pool_total',
        'prize_pool_first',
        'prize_pool_second',
        'prize_pool_third',
    ];

    protected static $logName = 'compo';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'name',
        'slug',
        'description',
        'page_id',
        'challonge_subdomain',
        'challonge_url',
        'start_at',
        'last_sign_up_at',
        'end_at',
        'type',
        'signup_type',
        'signup_size',
        'min_signups',
        'max_signups',
        'prize_pool_total',
        'prize_pool_first',
        'prize_pool_second',
        'prize_pool_third',
    ];

    public function scopeThisYear($query)
    {
        return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
    }

    public function scopeLastYear($query)
    {
        return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
    }

    public function rules()
    {
        return $this->hasOne('LANMS\Page', 'id', 'page_id');
    }

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id')->withTrashed();
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id')->withTrashed();
    }

    public function signups()
    {
        return $this->hasMany('LANMS\CompoSignUp', 'compo_id', 'id');
    }

    public function signupsThisYear()
    {
        return $this->hasMany('LANMS\CompoSignUp', 'compo_id', 'id')->thisYear();
    }

}