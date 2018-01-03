<?php

namespace LANMS\Http\Controllers\Member;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index() {
		$reservations = \LANMS\SeatReservation::where('reservedby_id', '=', \Sentinel::getUser()->id)->get();
		return view('account.reservation.index')->with('reservations', $reservations);
	}
}
