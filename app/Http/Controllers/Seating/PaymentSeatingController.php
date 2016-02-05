<?php namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\SeatRows;
use LANMS\Seats;
use LANMS\SeatReservation;
use LANMS\SeatPayment;
use LANMS\SeatTicket;
use LANMS\StripeCustomer;
use anlutro\LaravelSettings\Facade as Setting;

use LANMS\Http\Requests\Seating\PaymentRequest;

use Cartalyst\Stripe\Exception\CardErrorException;

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
	public function charge($slug, PaymentRequest $request)
	{
		$seat = Seats::where('slug', $slug)->first();

		$stripecust = StripeCustomer::where('user_id', Sentinel::getUser()->id)->first();
		
		if($stripecust == null) {
			$customer = \Stripe::customers()->create([
				'email' => Sentinel::getUser()->email,
			]);
			$stripecustomer 			= new StripeCustomer;
			$stripecustomer->cus 		= $customer['id'];
			$stripecustomer->user_id	= Sentinel::getUser()->id;
			$stripecustomer->save();

			$stripecust = $stripecustomer; 
		}

		$getcards = \Stripe::cards()->all($stripecust->cus);
		$carddata = $getcards['data'];

		$cardNumber    		= $request->get('cardNumber');
		$cardMonthExpiry 	= $request->get('cardMonthExpiry');
		$cardCVC       		= $request->get('cardCVC');
		$cardYearExpiry  	= $request->get('cardYearExpiry');

		try {
			$token = \Stripe::tokens()->create([
				'card' => [
					'number'    => $cardNumber,
					'exp_month' => $cardMonthExpiry,
					'cvc'       => $cardCVC,
					'exp_year'  => $cardYearExpiry,
				],
			]);
			$card = \Stripe::cards()->create($stripecust->cus, $token['id']);
		} catch (CardErrorException $e) {
			// Get the status code
			$code = $e->getCode();

			// Get the error message returned by Stripe
			$message = $e->getMessage();

			// Get the error type returned by Stripe
			$type = $e->getErrorType();

			return Redirect::route('seating-pay', $slug)->with('messagetype', 'error')
								->with('message', 'Credit card information is invalid. Please check your information and try again.');
		}

		$charge = \Stripe::charges()->create([
			'customer' => $stripecust->cus,
			'currency' => Setting::get('SEATING_SEAT_PRICE_CURRENCY'),
			'amount'   => Setting::get('SEATING_SEAT_PRICE'),
		]);

		$reservation 					= $seat->reservations;
		$reservationid 					= $reservation->first()->id;

		$seatpayment 					= new SeatPayment;
		$seatpayment->stripecharge 		= $charge['id'];
		$seatpayment->reservation_id	= $reservationid;
		$seatpayment->user_id			= Sentinel::getUser()->id;
		$seatpayment->save();

		$seatticket 					= new SeatTicket;
		$seatticket->barcode 			= mt_rand(1000000000, 2147483647);
		$seatticket->reservation_id		= $reservationid;
		$seatticket->user_id			= Sentinel::getUser()->id;
		$seatticket->save();

		$reservationchange				= SeatReservation::find($reservationid);
		$reservationchange->status_id	= 1;
		$reservationchange->payment_id	= $seatpayment->id;
		$reservationchange->ticket_id	= $seatticket->id;
		$reservationchange->save();

		return Redirect::route('seating')->with('messagetype', 'success')
								->with('message', $seat->name.' is now reserved and paid for! We are exited to have you, welcome!');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function paylater($slug)
	{
		$seat 							= Seats::where('slug', $slug)->first();

		$reservation 					= $seat->reservations;
		$reservationid 					= $reservation->first()->id;

		$seatticket 					= new SeatTicket;
		$seatticket->barcode 			= mt_rand(1000000000, 2147483647);
		$seatticket->reservation_id		= $reservationid;
		$seatticket->user_id			= Sentinel::getUser()->id;
		$seatticket->save();

		$reservationchange				= SeatReservation::find($reservationid);
		$reservationchange->status_id	= 1;
		$reservationchange->ticket_id	= $seatticket->id;
		$reservationchange->save();

		return Redirect::route('seating')->with('messagetype', 'success')
								->with('message', $seat->name.' is now reserved and paid for! We are exited to have you, welcome!');

	}


}