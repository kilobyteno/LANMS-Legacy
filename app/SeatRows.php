<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatRows extends Model {

	protected $table = 'seat_rows';

	public function seats() {
		return $this->hasMany('Seats', 'row_id');
	}

}
