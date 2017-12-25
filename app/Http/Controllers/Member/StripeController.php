<?php

namespace LANMS\Http\Controllers\Member;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class StripeController extends Controller
{
	public function getPayments() {
		$user 		= Sentinel::getUser();
		$scus 		= $user->stripecustomer->cus;
		$charges 	= \Stripe::charges(array('customer' => $scus, 'limit' => 100))->all();
		$payments 	= $charges['data'];
		
		return view('account.billing.payments')->with('payments', $payments);
	}
}
