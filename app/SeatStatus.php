<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatStatus extends Model {

	protected $table = 'seat_statuses';

	protected $fillable = [
		'name',
		'slug',
	];

	function seats() {
		return $this->hasMany('Seats', 'status_id');
	}

}
