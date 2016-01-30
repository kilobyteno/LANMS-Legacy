<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Seats extends Model {

	protected $table = 'seats';

	protected $fillable = [
		'name',
		'slug',
		'row_id',
	];

	function row() {
		return $this->hasOne('SeatRows', 'id', 'row_id');
	}

	function reservations() {
		return $this->hasMany('SeatReservation', 'seat_id', 'id');
	}
	
}
