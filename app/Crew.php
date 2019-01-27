<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'crew';

    protected $fillable = [
        'user_id',
        'category_id',
        'year',
        'author_id',
        'editor_id',
    ];

    public function scopeThisYear($query)
    {
        return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
    }

    public function scopeLastYear($query)
    {
        return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
    }

    public function category()
    {
        return $this->hasOne('CrewCategory', 'id', 'category_id');
    }

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id')->withTrashed();
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id')->withTrashed();
    }

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id')->withTrashed();
    }

    public function skills()
    {
        return $this->belongsToMany('LANMS\CrewSkill');
    }
}
