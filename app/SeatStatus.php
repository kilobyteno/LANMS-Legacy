<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatStatus extends Model {

	protected $table = 'seat_statuses';

	protected $fillable = [
		'name',
		'slug',
		'reservation_id',
	];

	function reservations() {
		return $this->hasMany('SeatReservations', 'reservation_id');
	}

}
