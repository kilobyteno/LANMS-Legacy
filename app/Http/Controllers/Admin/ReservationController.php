<?php namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\Seats;
use LANMS\SeatReservation;
use LANMS\SeatTicket;
use LANMS\SeatRows;
use Vsmoraes\Pdf\PdfFacade as PDF;

use LANMS\Http\Requests\Admin\ReservationEditRequest;

class ReservationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.reservation.*'])) {
			$reservations 	= SeatReservation::thisYear()->get();
			$rows 			= SeatRows::all();
			return view('seating.reservation.index')->withRows($rows)->withReservations($reservations);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	public function showPDF($slug)
	{
		$slug = strtolower($slug); // Just to be sure it is correct
		$currentseat = Seats::where('slug', $slug)->first();
		if($currentseat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}

		if($currentseat->reservationsThisYear()->first() == null) {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'Could not find valid ticket.');
		}

		if(Sentinel::getUser()->id == $currentseat->reservationsThisYear()->first()->reservedfor->id) {
			$html = view('seating.pdf.ticket')->with('seat', $currentseat)->render();
			return PDF::load($html)->show();
		} else {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You are not allowed to view this ticket.');
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
			return Redirect::back()->with('messagetype', 'warning')
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
			
			$reservation 					= SeatReservation::find($id);

			$updateseat						= Seats::find($reservation->seat->id);
			$updateseat->reservation_id		= $reservation->id;
			$updateseat->save();

			if($reservation->status_id == 1) { // 1 = Reserved, 2 = Temporary Reserved
				
				if($reservation->ticket) {
					$reservation->ticket->delete();
				}

				$seatticket 					= new SeatTicket;
				$seatticket->barcode 			= mt_rand(1000000000, 2147483647);
				$seatticket->reservation_id		= $reservation->id;
				$seatticket->user_id			= $request->get('reservedfor_id');
				$seatticket->save();

				$reservation->ticket_id 		= $seatticket->id;

			}

			$reservation->reservedfor_id 	= $request->get('reservedfor_id');
			$reservation->seat_id 			= $request->get('seat_id');

			if($reservation->save()) {
				return Redirect::route('admin-seating-reservation-edit', $id)
						->with('messagetype', 'success')
						->with('message', 'The reservation has now been saved!');
			} else {
				return Redirect::route('admin-seating-reservation-edit', $id)
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the reservation.');
			}
		} else {
			return Redirect::back()->with('messagetype', 'warning')
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

			$seat = $reservation->seat;
			$seat->reservation_id = 0;
			$seat->save();

			if($reservation->ticket) {
				$reservation->ticket->delete();
			}
			
			if($reservation->delete()) {
				return Redirect::route('admin-seating-reservations')
						->with('messagetype', 'success')
						->with('message', 'The reservation has now been deleted!');
			} else {
				return Redirect::route('admin-seating-reservations')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while deleting the reservation.');
			}
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
