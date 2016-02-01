<?php namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\SeatRows;
use LANMS\Seats;
use LANMS\SeatReservation;
use anlutro\LaravelSettings\Facade as Setting;

use LANMS\Http\Requests\Seating\SeatReserveRequest;

class ReserveSeatingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rows 				= SeatRows::all();
		$userreservations 	= Sentinel::getUser()->reservations;
		return view('seating.index')->withRows($rows)->with('userreservations', $userreservations);
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
		if($currentseat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
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

		$slug 			= strtolower($slug); // Just to be sure it is correct
		$seat 			= Seats::where('slug', $slug)->first();
		$reservedforid 	= $request->get('reservedfor');
		$reservedfor 	= Sentinel::findById($reservedforid);

		if($seat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(substr($slug, 0, 1) == 'a') {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats on the A-row.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
		}
		if($seat->reservations->count() >= 1) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Seat has already been reserved');
		}

		/* LOGGED IN USER */
		if (Sentinel::getUser()->addresses->count() == 0) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
								->with('message', 'It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address.');
		}
		if(Sentinel::getUser()->reservations->count() >= 5) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You are not allowed to reserve more seats.');
		}
		if($request->get('reservedfor') == Sentinel::getUser()->id && Sentinel::getUser()->ownreservations->count() >= 1) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'info')
								->with('message', 'You cannot reserve more than one seat to yourself. Please select another user you want to reserve this seat for.');
		}

		/* RESERVED FOR USER */
		if ($reservedfor->addresses->count() == 0) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
								->with('message', 'It seems like '.$reservedfor->username.' does not have any addresses attached to their account. They will not be able to reserve any seat before they have added one primary address.');
		}
		if($reservedfor->reservations->count() >= 5) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', '<em>'.$reservedfor->username.'</em> are not allowed to reserve more seats.');
		}
		
		$seatreservation 					= new SeatReservation;
		$seatreservation->seat_id 			= $seat->id;
		$seatreservation->reservedby_id 	= Sentinel::getUser()->id;
		$seatreservation->reservedfor_id	= $reservedforid;
		$seatreservation->status_id 		= 2; // 1 = Reserved, 2 = Temporary Reserved

		$seatreservationsave 				= $seatreservation->save();

		if($seatreservationsave) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'success')
								->with('message', 'You have successfully reserved this seat!');
		} else {
			return Redirect::route('seating')->with('messagetype', 'error')
								->with('message', 'Something went wrong while saving the reservation!');
		}
	}

}
