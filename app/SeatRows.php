<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SeatRows extends Model
{
    use SoftDeletes, LogsActivity, HasSlug;

    protected $dates = ['deleted_at'];
    protected $table = 'seat_rows';

    protected $fillable = [
        'name',
        'slug',
        'author_id',
        'editor_id',
    ];

    protected static $logName = 'seat_row';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'name',
        'slug',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function seats()
    {
        return $this->hasMany('Seats', 'row_id');
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
