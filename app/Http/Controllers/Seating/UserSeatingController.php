<?php namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\SeatRows;
use LANMS\Seats;

class UserSeatingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rows = SeatRows::all();
		return view('seating.index')->withRows($rows);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function reserve($id)
	{
		if(substr($id, 0, 1) == 'A' || substr($id, 0, 1) == 'a') {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats on the A-row.');
		}
		$rows = SeatRows::all();
		$seat = Seats::find($id);
		return view('seating.reserve')->withRows($rows)->withSeat($seat);
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
