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
        if (is_null($seat->tickettype) || !$seat->tickettype->active) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.notpossibleonthisrow'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if ($seat->reservationsThisYear()->count() >= 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.alreadyreserved'));
        }

        /* LOGGED IN USER */
        if (Sentinel::getUser()->stripecustomer) {
            $stripe_customer_code = Sentinel::getUser()->stripecustomer->cus;
            $invoices = \Stripe::invoices()->all(array('customer' => $stripe_customer_code, 'limit' => 100));
            foreach ($invoices['data'] as $invoice) {
                if ($invoice['paid'] == false && $invoice['status'] != 'draft') {
                    return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.unpaidinvoice'));
                }
            }
        }
        if (!Sentinel::getUser()->birthdate) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.nobirthday'));
        }
        if (Sentinel::getUser()->addresses->count() == 0) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.noaddresses'));
        }
        if (Sentinel::getUser()->reservationsThisYear()->count() >= 5) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.limit'));
        }
        if ($request->get('reservedfor') == Sentinel::getUser()->id && Sentinel::getUser()->ownReservationsThisYear()->count() >= 1) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'info')
                                ->with('message', trans('seating.reservation.alert.limitself'));
        }

        /* RESERVED FOR USER */
        if (!$reservedfor->birthdate) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.nobirthdayfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->addresses->count() == 0) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.noaddressesfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->reservationsThisYear()->count() >= 5) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.limitreservedfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->ownReservationsThisYear()->count() >= 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.alreadyreservedfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }

        if (\Setting::get('SEATING_YEAR')) {
            $year = \Setting::get('SEATING_YEAR');
        } else {
            $year = \Carbon::now()->year;
        }

        $seatreservation                    = new SeatReservation;
        $seatreservation->seat_id           = $seat->id;
        $seatreservation->reservedby_id     = Sentinel::getUser()->id;
        $seatreservation->reservedfor_id    = $reservedforid;
        $seatreservation->status_id         = 2; // 1 = Reserved, 2 = Temporary Reserved
        $seatreservation->year              = $year;

        $seatreservationsave                = $seatreservation->save();

        $updateseat                         = Seats::find($seat->id);
        $updateseat->reservation_id         = $seatreservation->id;
        $updateseat->save();

        if ($seatreservationsave) {
            return Redirect::route('seating')->with('messagetype', 'success')
                                ->with('message', trans('seating.reservation.alert.success'));
        } else {
            return Redirect::route('seating')->with('messagetype', 'error')
                                ->with('message', trans('seating.reservation.alert.failure'));
        }
    }

    public function ticketdownload($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $seat = Seats::where('slug', $slug)->first();
        if (is_null($seat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }

        $ticket = $seat->reservationsThisYear()->first()->ticket;
        $reservedfor = $seat->reservationsThisYear()->first()->reservedfor;
        $payment = $seat->reservationsThisYear()->first()->payment;
        if (Sentinel::getUser()->id == $reservedfor->id && !is_null($ticket)) {
            $html = view('seating.pdf.ticket')->with('seat', $seat)->with('payment', $payment)->with('reservedfor', $reservedfor)->with('ticket', $ticket)->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->stream();
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.ticketnoaccess'));
        }
    }

    public function consentform()
    {
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
        } else {
            $user = null;
        }
        $html = view('seating.pdf.consentform')->withUser($user)->render();
        return PDF::loadHTML($html)->stream();
    }

    public function destroy($id)
    {
        $reservation = SeatReservation::find($id);

        if ($reservation == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.destroy.notfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if (Sentinel::getUser()->id <> $reservation->reservedby->id) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.destroy.noaccess'));
        }
        if (SeatReservation::getRealExpireTime($id) == "expired") {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.destroy.cantberemovedafter', ['hours' => \Setting::get('SEATING_SEAT_EXPIRE_HOURS')]));
        }
        if ($reservation->status_id == 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.reservation.alert.destroy.cantberemoved'));
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
                    ->with('message', trans('seating.reservation.alert.destroy.success'));
        } else {
            return Redirect::route('seating')
                ->with('messagetype', 'danger')
                ->with('message', trans('seating.reservation.alert.destroy.failure'));
        }
    }
}
