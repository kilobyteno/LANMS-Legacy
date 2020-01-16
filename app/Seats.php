<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LANMS\TicketType;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Seats extends Model
{
    use SoftDeletes, LogsActivity, HasSlug;

    protected $dates = ['deleted_at'];
    protected $table = 'seats';

    protected $fillable = [
        'name',
        'slug',
        'row_id',
        'tickettype_id',
        'author_id',
        'editor_id',
    ];

    protected static $logName = 'seat';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'name',
        'slug',
        'row_id',
        'tickettype_id',
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

    public function tickettype()
    {
        return $this->hasOne(TicketType::class, 'id', 'tickettype_id');
    }

    public function row()
    {
        return $this->hasOne('SeatRows', 'id', 'row_id');
    }

    public function reservations()
    {
        return $this->hasMany('SeatReservation', 'seat_id', 'id');
    }

    public function reservationThisYear()
    {
        return $this->hasOne('SeatReservation', 'seat_id', 'id')->thisYear();
    }

    public function reservationsThisYear()
    {
        return $this->hasMany('SeatReservation', 'seat_id', 'id')->thisYear();
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
