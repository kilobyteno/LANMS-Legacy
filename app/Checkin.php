<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Checkin extends Model
{
    use LogsActivity;

    protected $fillable = [
        'ticket_id',
        'bandnumber',
        'year',
    ];
    protected $table = 'checkins';

    protected static $logName = 'checkin';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'ticket_id',
        'bandnumber',
    ];

    public function ticket()
    {
        return $this->hasOne('SeatTicket', 'id', 'ticket_id');
    }

    public function ticketThisYear()
    {
        return $this->hasOne('SeatTicket', 'id', 'ticket_id')->thisYear()->first();
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
