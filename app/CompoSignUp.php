<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CompoSignUp extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'compo_sign_ups';

    protected $fillable = [
        'compo_id',
        'team_id',
        'user_id',
        'year',
    ];

    protected static $logName = 'compo_sign_up';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
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
        return $this->hasOne('\LANMS\CompoTeam', 'id', 'team_id');
    }

    public function compo()
    {
        return $this->hasOne('\LANMS\Compo', 'id', 'compo_id');
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
