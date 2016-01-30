<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatReservation extends Model {

	protected $table = 'seat_reservations';

	protected $fillable = [
		'seat_id',
		'reservedby_id',
		'reservedfor_id',
		'payment_id',
		'ticket_id',
		'status_id',
	];

	function reservedfor() {
		return $this->hasOne('User', 'id', 'reservedfor_id');
	}

	function reservedby() {
		return $this->hasOne('User', 'id', 'reservedby_id');
	}

	function payment() {
		return $this->hasOne('SeatPayment', 'id', 'payment_id');
	}

	function ticket() {
		return $this->hasOne('SeatTicket', 'id', 'ticket_id');
	}

	function status() {
		return $this->hasOne('SeatReservationStatus', 'id', 'status_id');
	}

	function seat() {
		return $this->hasOne('Seat', 'id', 'seat_id');
	}

}
