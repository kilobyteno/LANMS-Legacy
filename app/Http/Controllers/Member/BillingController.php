<?php

namespace LANMS\Http\Controllers\Member;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class BillingController extends Controller
{
    public function getReceipt($id)
    {
        $payment = \LANMS\SeatPayment::find($id);
        $charge = \Stripe::charges()->find($payment->stripecharge);
        return view('seating.pdf.receipt')->with('payment', $payment)->with('charge', $charge);
        //return \PDF::loadView('seating.pdf.receipt')->stream();
    }

    public function getPayments()
    {
        $payments = Sentinel::getUser()->seatpayments;
        return view('account.billing.payments')->with('payments', $payments);
    }

    public function getPayment($id)
    {
        $seatpayment = \LANMS\SeatPayment::where('user_id', \Sentinel::getUser()->id)->find($id);
        if (is_null($seatpayment)) {
            abort(403);
        }
        $charge = \Stripe::charges()->find($seatpayment->stripecharge);
        return view('account.billing.payment')->with('seatpayment', $seatpayment)->with('charge', $charge);
    }

    public function getCharges()
    {
        $user       = Sentinel::getUser();
        $scus       = $user->stripecustomer;

        if ($scus) {
            $sccus      = $scus->cus;
            $charges    = \Stripe::charges()->all(array('customer' => $sccus, 'limit' => 100));
            $charges    = $charges['data'];
        } else {
            $charges    = [];
        }
        
        return view('account.billing.charges')->with('charges', $charges);
    }

    public function getSubscriptions()
    {
        $user       = Sentinel::getUser();
        $scus       = $user->stripecustomer;

        if ($scus) {
            $sccus = $scus->cus;
            $subscriptions = \Stripe::subscriptions()->all($sccus);
            $subscriptions = $subscriptions['data'];
        } else {
            $subscriptions = [];
        }

        //dd($subscriptions);
        
        return view('account.billing.subscriptions')->with('subscriptions', $subscriptions);
    }

    public function getSubscription($id)
    {
        $user       = Sentinel::getUser();
        $scus       = $user->stripecustomer;

        if ($scus) {
            $sccus = $scus->cus;
            $subscription = \Stripe::subscriptions()->find($sccus, $id);
        } else {
            $subscription = [];
        }

        dd($subscription);
        
        return view('account.billing.subscription')->with('subscription', $subscription);
    }
}
