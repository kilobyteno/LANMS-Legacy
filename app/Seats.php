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

	function status() {
		return $this->hasOne('SeatStatus', 'id', 'status_id');
	}

	function scopeStatusReserved($query) {
		return $query->status->name == 'Reserved';
	}

	function scopeStatusOpen($query) {
		return $query->status->name == 'Open';
	}

	function scopeStatusTemporaryReserved($query) {
		return $query->status->name == 'Temporary Reserved';
	}

}
