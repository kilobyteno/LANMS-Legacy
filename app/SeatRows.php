<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatRows extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'seat_rows';

	public function seats() {
		return $this->hasMany('Seats', 'row_id');
	}

}
