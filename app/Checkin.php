<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model {

	protected $fillable = [
		'ticket_id',
		'band',
	];
	protected $table = 'checkins';

	function ticket() {
		return $this->hasOne('SeatTicket', 'id', 'ticket_id');
	}

}
