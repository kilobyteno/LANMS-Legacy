<?php

namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\SeatRows;
use LANMS\Seats;
use LANMS\SeatReservation;
use anlutro\LaravelSettings\Facade as Setting;
use PDF;

use LANMS\Http\Requests\Seating\SeatReserveRequest;

class ReserveSeatingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rows               = SeatRows::all();
        $reservations       = Sentinel::getUser()->reservationsThisYear;
        $ownreservations    = Sentinel::getUser()->ownReservationsThisYear;
        return view('seating.index')
                ->withRows($rows)
                ->with('reservations', $reservations)
                ->with('ownreservations', $ownreservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function show($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $currentseat = Seats::where('slug', $slug)->first();
        if (is_null($currentseat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }
        $rows = SeatRows::all();
        return view('seating.show')->withRows($rows)->with('currentseat', $currentseat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function reserve($slug, SeatReserveRequest $request)
    {
        $slug           = strtolower($slug); // Just to be sure it is correct
        $seat           = Seats::where('slug', $slug)->first();
        $reservedforid  = $request->get('reservedfor');
        $reservedfor    = Sentinel::findById($reservedforid);

        if (is_null($seat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }
        if (substr($slug, 0, 1) == 'a') {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.notpossibleonthisrow'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if ($seat->reservationsThisYear()->count() >= 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.alreadyreserved'));
        }

        /* LOGGED IN USER */
        if (!Sentinel::getUser()->birthdate) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.nobirthday'));
        }
        if (Sentinel::getUser()->addresses->count() == 0) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.noaddresses'));
        }
        if (Sentinel::getUser()->reservationsThisYear()->count() >= 5) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.limit'));
        }
        if ($request->get('reservedfor') == Sentinel::getUser()->id && Sentinel::getUser()->ownReservationsThisYear()->count() >= 1) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'info')
                                ->with('message', trans('seating.alert.reservation.limitself'));
        }

        /* RESERVED FOR USER */
        if (!$reservedfor->birthdate) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.nobirthdayfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->addresses->count() == 0) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.noaddressesfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->reservationsThisYear()->count() >= 5) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.limitreservedfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->ownReservationsThisYear()->count() >= 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.alreadyreservedfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }

        $seatreservation                    = new SeatReservation;
        $seatreservation->seat_id           = $seat->id;
        $seatreservation->reservedby_id     = Sentinel::getUser()->id;
        $seatreservation->reservedfor_id    = $reservedforid;
        $seatreservation->status_id         = 2; // 1 = Reserved, 2 = Temporary Reserved
        $seatreservation->year              = \Setting::get('SEATING_YEAR');

        $seatreservationsave                = $seatreservation->save();

        $updateseat                         = Seats::find($seat->id);
        $updateseat->reservation_id         = $seatreservation->id;
        $updateseat->save();

        if ($seatreservationsave) {
            return Redirect::route('seating')->with('messagetype', 'success')
                                ->with('message', trans('seating.alert.reservation.success'));
        } else {
            return Redirect::route('seating')->with('messagetype', 'error')
                                ->with('message', trans('seating.alert.reservation.failure'));
        }
    }

    public function ticketdownload($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $currentseat = Seats::where('slug', $slug)->first();
        if (is_null($currentseat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }

        if (Sentinel::getUser()->id == $currentseat->reservationsThisYear()->first()->reservedfor->id) {
            $html = view('seating.pdf.ticket')->with('currentseat', $currentseat)->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->stream();
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.ticketnoaccess'));
        }
    }

    public function consentform()
    {
        $html = view('seating.pdf.consentform')->render();
        return PDF::loadHTML($html)->stream();
    }

    public function destroy($id)
    {
        $reservation = SeatReservation::find($id);

        if ($reservation == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.destroy.notfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if (Sentinel::getUser()->id <> $reservation->reservedby->id) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.destroy.noaccess'));
        }
        if (SeatReservation::getRealExpireTime($id) == "expired") {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.destroy.cantberemovedafter', ['hours' => \Setting::get('SEATING_SEAT_EXPIRE_HOURS')]));
        }
        if ($reservation->status_id == 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.reservation.destroy.cantberemoved'));
        }

        $seat = $reservation->seat;
        $seat->reservation_id = 0;
        $seat->save();

        if ($reservation->ticket) {
            $reservation->ticket->delete();
        }
        
        if ($reservation->delete()) {
            return Redirect::route('seating')
                    ->with('messagetype', 'success')
                    ->with('message', trans('seating.alert.success'));
        } else {
            return Redirect::route('seating')
                ->with('messagetype', 'danger')
                ->with('message', trans('seating.alert.failure'));
        }
    }
}
