<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compo extends Model
{
    use SoftDeletes;

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

}