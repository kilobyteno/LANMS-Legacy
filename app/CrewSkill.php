<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CrewSkill extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];

    protected $table = 'crew_skills';

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'class',
        'author_id',
        'editor_id',
    ];

    protected static $logName = 'crew_skill';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title',
        'slug',
        'icon',
        'class',
    ];

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id');
    }

    public function crews()
    {
        return $this->belongsToMany('LANMS\Crew');
    }
}
