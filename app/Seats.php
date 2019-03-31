<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Seats extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected $table = 'seats';

    protected $fillable = [
        'name',
        'slug',
        'row_id',
        'author_id',
        'editor_id',
    ];

    protected static $logName = 'seat';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'name',
        'slug',
        'row_id',
    ];

    public function row()
    {
        return $this->hasOne('SeatRows', 'id', 'row_id');
    }

    public function reservations()
    {
        return $this->hasMany('SeatReservation', 'seat_id', 'id');
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
