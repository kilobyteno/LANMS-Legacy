<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatTicket extends Model {

	protected $table = 'seat_tickets';

	protected $fillable = [
		'barcode',
		'reservation_id',
		'user_id',
	];

	function reservation() {
		return $this->hasOne('SeatReservation', 'id', 'reservation_id');
	}

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function checkin() {
		return $this->hasOne('Checkin', 'id', 'checkin_id');
	}

}
