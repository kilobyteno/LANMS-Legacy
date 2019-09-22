<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CrewCategory extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];

    protected $table = 'crew_categories';

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'editor_id',
        'active',
    ];

    protected static $logName = 'crew_category';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title',
        'slug',
        'active',
    ];

    public function crew()
    {
        return $this->hasMany('Crew', 'category_id', 'id');
    }

    public function crewThisYear()
    {
        return $this->hasMany('Crew', 'category_id', 'id')->thisYear();
    }

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id');
    }
}
