<?php namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LANMS\SeatReservation;

use LANMS\Http\Requests\Admin\ReservationEditRequest;

class ReservationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reservations = SeatReservation::all();
		return view('seating.reservation.index')->withReservations($reservations);
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reservation = SeatReservation::find($id);
		return view('seating.reservation.edit')->withReservation($reservation);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ReservationEditRequest $request)
	{
		$reservation 					= SeatReservation::find($id);

		$updateseat						= Seats::find($reservation->seat->id);
		$updateseat->reservation_id		= $reservation->id;
		$updateseat->save();

		if($seatreservation->status_id == 1) { // 1 = Reserved, 2 = Temporary Reserved
			
			$reservation->ticket->delete();

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
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
