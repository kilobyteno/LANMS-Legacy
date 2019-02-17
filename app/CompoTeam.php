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
}
