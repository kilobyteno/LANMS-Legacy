<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrewSkill extends Model
{
    use SoftDeletes;

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
