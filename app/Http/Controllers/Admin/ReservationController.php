<?php

namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\Seats;
use LANMS\SeatReservation;
use LANMS\SeatTicket;
use LANMS\SeatRows;
use PDF;
use anlutro\LaravelSettings\Facade as Setting;

use LANMS\Http\Requests\Admin\ReservationEditRequest;
use LANMS\Http\Requests\Seating\SeatReserveRequest;

class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Sentinel::getUser()->hasAccess(['admin.reservation.*'])) {
            $reservations   = SeatReservation::thisYear()->get();
            $rows           = SeatRows::orderBy('sort_order', 'asc')->get();
            return view('seating.reservation.index')->withRows($rows)->withReservations($reservations);
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function paylater($slug)
    {
        $seat                           = Seats::where('slug', $slug)->first();

        if ($seat == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', 'Could not find seat.');
        }
        if ($seat->reservationsThisYear->first()) {
            if ($seat->reservationsThisYear->first()->payment_id != 0) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', 'This seat already has a payment assigned to it.');
            }
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', 'There was no reservation found for this seat.');
        }

        if (\Setting::get('SEATING_YEAR')) {
            $year = \Setting::get('SEATING_YEAR');
        } else {
            $year = \Carbon::now()->year;
        }

        $reservation                    = $seat->reservationsThisYear->first();
        $reservationid                  = $reservation->id;

        $seatticket                     = new SeatTicket;
        $seatticket->barcode            = mt_rand(1000000000, 2147483647);
        $seatticket->reservation_id     = $reservationid;
        $seatticket->user_id            = $reservation->reservedfor_id;
        $seatticket->year               = $year;
        $seatticket->save();

        $reservationchange              = SeatReservation::find($reservationid);
        $reservationchange->status_id   = 1;
        $reservationchange->ticket_id   = $seatticket->id;
        $reservationchange->save();

        return Redirect::route('admin-seating-reservations')->with('messagetype', 'success')
                                ->with('message', $seat->name.' is now reserved and marked as pay at entrance!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        if (Sentinel::getUser()->hasAccess(['admin.reservation.create'])) {
            $slug = strtolower($slug); // Just to be sure it is correct
            $seat = Seats::where('slug', $slug)->first();
            if ($seat == null) {
                return Redirect::route('admin-seating-reservations')->with('messagetype', 'warning')
                                    ->with('message', 'Could not find seat.');
            }
            $rows = SeatRows::orderBy('sort_order', 'asc')->get();
            return view('seating.reservation.show')->with('seat', $seat);
        } else {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    public function showPDF($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $seat = Seats::where('slug', $slug)->first();
        if (is_null($seat)) {
            return Redirect::route('admin-seating-reservations')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }

        if ($seat->reservationsThisYear()->first() == null) {
            return Redirect::route('admin-seating-reservations')->with('messagetype', 'warning')
                                ->with('message', 'Could not find valid ticket.');
        }

        $ticket = $seat->reservationsThisYear()->first()->ticket;
        $reservedfor = $seat->reservationsThisYear()->first()->reservedfor;
        $payment = $seat->reservationsThisYear()->first()->payment;

        \Theme::set('vobilet');
        $html = view('seating.pdf.ticket')->with('seat', $seat)->with('payment', $payment)->with('reservedfor', $reservedfor)->with('ticket', $ticket)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function reserve($slug, SeatReserveRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.reservation.create'])) {
            $slug           = strtolower($slug); // Just to be sure it is correct
            $seat           = Seats::where('slug', $slug)->first();
            $reservedforid  = $request->get('reservedfor');
            $reservedfor    = Sentinel::findById($reservedforid);

            if ($seat == null) {
                return Redirect::route('admin-seating-reservations')->with('messagetype', 'warning')
                                    ->with('message', 'Could not find seat.');
            }
            if ($seat->reservationsThisYear()->count() >= 1) {
                return Redirect::route('admin-seating-reservations')->with('messagetype', 'warning')
                                    ->with('message', 'Seat has already been reserved');
            }

            /* RESERVED FOR USER */
            if (!$reservedfor->hasAddress()) {
                return Redirect::route('admin-seating-reservation-show', $slug)->with('messagetype', 'warning')
                                    ->with('message', 'It seems like '.$reservedfor->username.' does not have a address attached to their account. They will not be able to reserve any seat before they have added a address.');
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
                return Redirect::route('admin-seating-reservations')->with('messagetype', 'success')
                                    ->with('message', 'You have successfully reserved this seat!');
            } else {
                return Redirect::route('admin-seating-reservations')->with('messagetype', 'error')
                                    ->with('message', 'Something went wrong while saving the reservation!');
            }
        } else {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.reservation.update'])) {
            $reservation = SeatReservation::find($id);
            return view('seating.reservation.edit')->withReservation($reservation);
        } else {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, ReservationEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.reservation.update'])) {
            $reservation                    = SeatReservation::find($id);

            $updateseat                     = Seats::find($reservation->seat->id);
            $updateseat->reservation_id     = $reservation->id;
            $updateseat->save();

            if ($reservation->status_id == 1) {
                // 1 = Reserved, 2 = Temporary Reserved
                
                if ($reservation->ticket) {
                    $reservation->ticket->delete();
                }

                $seatticket                     = new SeatTicket;
                $seatticket->barcode            = mt_rand(1000000000, 2147483647);
                $seatticket->reservation_id     = $reservation->id;
                $seatticket->user_id            = $request->get('reservedfor');
                $seatticket->save();

                $reservation->ticket_id         = $seatticket->id;
            }

            $reservation->reservedfor_id    = $request->get('reservedfor');
            $reservation->seat_id           = $request->get('seat_id');

            if ($reservation->save()) {
                return Redirect::route('admin-seating-reservation-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The reservation has now been saved!');
            } else {
                return Redirect::route('admin-seating-reservation-edit', $id)
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the reservation.');
            }
        } else {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.reservation.destroy'])) {
            $reservation = SeatReservation::find($id);

            if ($reservation->ticket) {
                if ($reservation->ticket->checkin) {
                    return Redirect::route('admin-seating-reservations')
                            ->with('messagetype', 'error')
                            ->with('message', 'Cannot delete reservation, user has checked-in.');
                }
            }

            $seat = $reservation->seat;
            $seat->reservation_id = 0;
            $seat->save();

            if ($reservation->ticket) {
                $reservation->ticket->delete();
            }
            
            if ($reservation->delete()) {
                return Redirect::route('admin-seating-reservations')
                        ->with('messagetype', 'success')
                        ->with('message', 'The reservation has now been deleted!');
            } else {
                return Redirect::route('admin-seating-reservations')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the reservation.');
            }
        } else {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }
}
