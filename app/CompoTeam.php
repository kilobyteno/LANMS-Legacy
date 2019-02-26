<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class CompoTeam extends Model
{

    protected $table = 'compo_teams';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function leader()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function players()
    {
        return $this->belongsToMany('LANMS\User');
    }

    public function composignups()
    {
        return $this->hasMany('LANMS\CompoSignUp', 'team_id', 'id');
    }

    public function composignupsThisYear()
    {
        return $this->hasMany('LANMS\CompoSignUp', 'team_id', 'id')->thisYear();
    }

    public function composignupsLastYear()
    {
        return $this->hasMany('LANMS\CompoSignUp', 'team_id', 'id')->lastYear();
    }
}
