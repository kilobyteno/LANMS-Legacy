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
        $rows = SeatRows::orderBy('sort_order', 'asc')->get();
        $reservations = Sentinel::getUser()->reservationsThisYear;
        $ownreservations = Sentinel::getUser()->ownReservationsThisYear;
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
                                ->with('message', __('seating.alert.seatnotfound'));
        }
        $rows = SeatRows::orderBy('sort_order', 'asc')->get();
        return view('seating.show')->withRows($rows)->with('currentseat', $currentseat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function reserve($slug, SeatReserveRequest $request)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $seat = Seats::where('slug', $slug)->first();
        $reservedforid = $request->get('reservedfor');
        $reservedfor = Sentinel::findById($reservedforid);
        if (!$reservedfor) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.aler.reservedforusernotfound'));
        }

        if (is_null($seat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.alert.seatnotfound'));
        }
        if (is_null($seat->tickettype) || !$seat->tickettype->active) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.notpossibleonthisrow'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.alert.seatingclosed'));
        }
        if ($seat->reservationsThisYear()->count() >= 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.alreadyreserved'));
        }

        /* LOGGED IN USER */
        if (Sentinel::getUser()->stripecustomer) {
            $stripe_customer_code = Sentinel::getUser()->stripecustomer->cus;
            $invoices = \Stripe::invoices()->all(array('customer' => $stripe_customer_code, 'limit' => 100));
            foreach ($invoices['data'] as $invoice) {
                if ($invoice['paid'] == false && $invoice['status'] != 'draft' && $invoice['status'] != 'void') {
                    return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.alert.unpaidinvoice'));
                }
            }
        }
        if (!Sentinel::getUser()->birthdate) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.nobirthday'));
        }
        if (!Sentinel::getUser()->hasAddress()) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.noaddress'));
        }
        if (Sentinel::getUser()->reservationsThisYear()->count() >= 5) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.limit'));
        }
        if ($request->get('reservedfor') == Sentinel::getUser()->id && Sentinel::getUser()->ownReservationsThisYear()->count() >= 1) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'info')
                                ->with('message', __('seating.reservation.alert.limitself'));
        }

        /* RESERVED FOR USER */
        if (!$reservedfor->birthdate) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.nobirthdayfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if (!$reservedfor->hasAddress()) {
            return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.noaddressfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->reservationsThisYear()->count() >= 5) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.limitreservedfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
        }
        if ($reservedfor->ownReservationsThisYear()->count() >= 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.alreadyreservedfor', ['name' => \User::getFullnameAndNicknameByID($reservedfor->id)]));
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
                                ->with('message', __('seating.reservation.alert.success'));
        } else {
            return Redirect::route('seating')->with('messagetype', 'error')
                                ->with('message', __('seating.reservation.alert.failure'));
        }
    }

    public function ticketdownload($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $seat = Seats::where('slug', $slug)->first();
        if (is_null($seat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.alert.seatnotfound'));
        }

        $ticket = $seat->reservationsThisYear()->first()->ticket;
        $reservedfor = $seat->reservationsThisYear()->first()->reservedfor;
        $payment = $seat->reservationsThisYear()->first()->payment;
        if (Sentinel::getUser()->id == $reservedfor->id && !is_null($ticket)) {
            $html = view('seating.pdf.ticket')->with('seat', $seat)->with('payment', $payment)->with('reservedfor', $reservedfor)->with('ticket', $ticket)->render();
            return PDF::loadHTML($html)->download();
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.ticketnoaccess'));
        }
    }

    public function ticketshow($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $seat = Seats::where('slug', $slug)->first();
        if (is_null($seat)) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.alert.seatnotfound'));
        }
        $reservation = $seat->reservationsThisYear()->first();
        if (!Sentinel::getUser()->id == $reservation->reservedfor->id && !$reservation->ticket) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.ticketnoaccess'));
        }
        return view('seating.ticket')->with('reservation', $reservation);
    }

    public function consentform()
    {
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
        } else {
            $user = null;
        }
        $html = view('seating.pdf.consentform')->withUser($user)->render();
        return PDF::loadHTML($html)->download();
    }

    public function destroy($id)
    {
        $reservation = SeatReservation::find($id);

        if ($reservation == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.destroy.notfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.alert.seatingclosed'));
        }
        if (Sentinel::getUser()->id !== $reservation->reservedby->id) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.destroy.noaccess'));
        }
        if (SeatReservation::getRealExpireTime($id) == "expired") {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.destroy.cantberemovedafter', ['hours' => \Setting::get('SEATING_SEAT_EXPIRE_HOURS')]));
        }
        if ($reservation->status_id == 1) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', __('seating.reservation.alert.destroy.cantberemoved'));
        }

        if ($reservation->ticket) {
            $reservation->ticket->delete();
        }
        
        if ($reservation->delete()) {
            return Redirect::route('seating')
                    ->with('messagetype', 'success')
                    ->with('message', __('seating.reservation.alert.destroy.success'));
        } else {
            return Redirect::route('seating')
                ->with('messagetype', 'danger')
                ->with('message', __('seating.reservation.alert.destroy.failure'));
        }
    }
}
