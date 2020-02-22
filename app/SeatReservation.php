<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class SeatReservation extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];

    protected $table = 'seat_reservations';

    protected $fillable = [
        'seat_id',
        'reservedby_id',
        'reservedfor_id',
        'payment_id',
        'ticket_id',
        'status_id',
        'year',
        'reminder_email_sent',
    ];

    protected static $logName = 'seat_reservations';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'seat_id',
        'reservedby_id',
        'reservedfor_id',
        'payment_id',
        'ticket_id',
        'status_id',
        'year',
        'reminder_email_sent',
    ];

    public function reservedfor()
    {
        return $this->hasOne('User', 'id', 'reservedfor_id');
    }

    public function reservedby()
    {
        return $this->hasOne('User', 'id', 'reservedby_id');
    }

    public function payment()
    {
        return $this->hasOne('SeatPayment', 'id', 'payment_id');
    }

    public function ticket()
    {
        return $this->hasOne('SeatTicket', 'id', 'ticket_id');
    }

    public function status()
    {
        return $this->hasOne('SeatReservationStatus', 'id', 'status_id');
    }

    public function seat()
    {
        return $this->hasOne('Seats', 'id', 'seat_id')->withTrashed();
    }

    public function scopeThisYear($query)
    {
        return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
    }

    public function scopeThisYearDecending($query)
    {
        return $query->where('year', '=', \Setting::get('SEATING_YEAR'))->orderBy('year', 'DESC');
    }

    public function scopeLastYear($query)
    {
        return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
    }

    public function scopeLastYearDecending($query)
    {
        return $query->where('year', '<', \Setting::get('SEATING_YEAR'))->orderBy('year', 'DESC');
    }

    public function scopePaid($query)
    {
        if (SeatPayment::where('reservation_id', '=', $this->id)->first() == null) {
            return false;
        } else {
            return true;
        }
    }

    public function scopeIsPaid($query)
    {
        return $query->where('payment_id', '<>', 0);
    }

    public function scopeOnlyReserved($query)
    {
        return $query->where('status_id', 1);
    }

    public function scopeOnlyTempReserved($query)
    {
        return $query->where('status_id', 2);
    }

    public function scopeGetExpireTime($query, $id)
    {
        $reservation = $query->where('id', '=', $id)->first();

        if ($reservation->status_id == 1) { // 1 = reserved
            return trans('global.time.never');
        }

        $time = strtotime('+'.\Setting::get('SEATING_SEAT_EXPIRE_HOURS').' hours', strtotime($reservation->created_at));

        $SECOND = 1;
        $MINUTE = 60 * $SECOND;
        $HOUR = 60 * $MINUTE;
        $DAY = 24 * $HOUR;
        $MONTH = 30 * $DAY;
        $after = $time - time();

        if ($after < 0) {
            return trans('global.time.expired');
        }

        if ($time == '0000-00-00 00:00:00') {
            return trans('global.time.never');
        }

        return \Carbon::parse($time)->diffForHumans();
    }

    public function scopeGetRealExpireTime($query, $id)
    {
        $reservation = $query->where('id', '=', $id)->first();

        $time = strtotime('+'.\Setting::get('SEATING_SEAT_EXPIRE_HOURS').' hours', strtotime($reservation->created_at));

        $SECOND = 1;
        $MINUTE = 60 * $SECOND;
        $HOUR = 60 * $MINUTE;
        $DAY = 24 * $HOUR;
        $MONTH = 30 * $DAY;
        $after = $time - time();

        if ($after < 0) {
            return true;
        }

        if ($time == '0000-00-00 00:00:00') {
            return trans('global.time.never');
        }

        return \Carbon::parse($time)->diffForHumans();
    }

    public function expiretimeinhours()
    {
        $time = strtotime('+'.\Setting::get('SEATING_SEAT_EXPIRE_HOURS').' hours', strtotime($this->created_at));

        $SECOND = 1;
        $MINUTE = 60 * $SECOND;
        $HOUR = 60 * $MINUTE;
        $DAY = 24 * $HOUR;
        $MONTH = 30 * $DAY;
        $after = $time - time();

        if ($after < 0) {
            return 0; // expired
        }

        return floor($after / 60 / 60);
    }
}
