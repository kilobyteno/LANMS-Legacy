<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class SeatTicket extends Model
{
    use LogsActivity;

    protected $table = 'seat_tickets';

    protected $fillable = [
        'barcode',
        'code',
        'reservation_id',
        'user_id',
        'checkin_id',
        'year',
    ];

    protected static $logName = 'seat_ticket';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'barcode',
        'code',
        'reservation_id',
        'user_id',
        'checkin_id',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($ticket) {
            $ticket->code = bin2hex(Str::random(3));
        });
    }

    public function reservation()
    {
        return $this->hasOne('SeatReservation', 'id', 'reservation_id');
    }

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function checkin()
    {
        return $this->hasOne('Checkin', 'id', 'checkin_id');
    }

    public function scopeNoCheckin($query)
    {
        return $query->where('checkin_id', '=', 0);
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
