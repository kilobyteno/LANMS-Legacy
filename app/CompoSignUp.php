<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class CompoSignUp extends Model
{
    protected $table = 'compo_sign_ups';

    protected $fillable = [
        'compo_id',
        'team_id',
        'user_id',
        'year',
    ];

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function team()
    {
        return $this->hasOne('\LANMS\CompoTeam', 'id', 'team_id');
    }

    public function scopeThisYear($query)
    {
        return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
    }

    public function scopeLastYear($query)
    {
        return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
    }
}
