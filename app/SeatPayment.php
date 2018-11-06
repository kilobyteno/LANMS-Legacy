<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Dialect\Gdpr\Anonymizable;

class SeatPayment extends Model {

	use Anonymizable;

	protected $table = 'seat_payments';

	protected $fillable = [
		'stripecharge',
		'user_id',
		'reservation_id',
	];

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function reservation() {
		return $this->hasOne('SeatReservation', 'id', 'reservation_id');
	}

}
