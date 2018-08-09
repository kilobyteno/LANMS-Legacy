<?php

namespace LANMS\Http\Controllers\Member;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class BillingController extends Controller
{
	public function getPayments() {
		$payments = Sentinel::getUser()->seatpayments;
		return view('account.billing.payments')->with('payments', $payments);
	}

	public function getPayment($id) {
		$seatpayment 	= \LANMS\SeatPayment::find($id);
		$charge 		= \Stripe::charges()->find($seatpayment->stripecharge);
		return view('account.billing.payment')->with('seatpayment', $seatpayment)->with('charge', $charge);
	}

	public function getCharges() {
		$user 		= Sentinel::getUser();
		$scus 		= $user->stripecustomer;

		if($scus) {
			$sccus 		= $scus->cus;
			$charges 	= \Stripe::charges(array('customer' => $scus, 'limit' => 100))->all();
			$charges 	= $charges['data'];
		} else {
			$charges 	= [];
		}
		
		return view('account.billing.charges')->with('charges', $charges);
	}

}
