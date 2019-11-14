<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SeatPayment extends Model
{

    use LogsActivity;

    protected $table = 'seat_payments';

    protected $fillable = [
        'stripecharge',
        'user_id',
        'reservation_id',
    ];

    protected static $logName = 'seat_payments';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'stripecharge',
        'user_id',
        'reservation_id',
    ];

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function reservation()
    {
        return $this->hasOne('SeatReservation', 'id', 'reservation_id');
    }
}
