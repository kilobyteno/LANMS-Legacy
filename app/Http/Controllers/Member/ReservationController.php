<?php

namespace LANMS\Http\Controllers\Member;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = \LANMS\SeatReservation::where('reservedby_id', '=', \Sentinel::getUser()->id)->orderBy('created_at', 'DESC')->get();
        return response()->view('account.reservations.index')->with('reservations', $reservations);
    }

    public function view($id)
    {
        $reservation = \LANMS\SeatReservation::find($id);
        abort_unless($reservation, 404);
        return response()->view('account.reservations.view')->with('reservation', $reservation);
    }
}
