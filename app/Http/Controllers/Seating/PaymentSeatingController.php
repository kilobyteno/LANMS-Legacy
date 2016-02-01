<?php namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LANMS\SeatRows;
use LANMS\Seats;
use LANMS\SeatReservation;
use anlutro\LaravelSettings\Facade as Setting;

class PaymentSeatingController extends Controller {


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pay($slug)
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
		return view('seating.pay')->withRows($rows)->with('currentseat', $currentseat);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function charge($id)
	{
		$stripecust = StripeCustomer::where('user_id', Sentinel::getUser()->id)->first();
		if($stripecust == null) {
			$customer = Stripe::customers()->create([
			    'email' => Sentinel::getUser()->email,
			]);
			$stripecustomer 			= new StripeCustomer;
			$stripecustomer->cus 		= $customer['id'];
			$stripecustomer->user_id	= Sentinel::getUser()->id;
			$stripecustomer->save();
		}
		
		$customers = \Stripe::customers()->all();

		foreach ($customers['data'] as $customer) {
		    dd($customer);
		}
	}


}
