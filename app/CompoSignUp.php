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
    ];

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function team()
    {
        return $this->hasOne('CompoTeam', 'id', 'team_id');
    }
}
