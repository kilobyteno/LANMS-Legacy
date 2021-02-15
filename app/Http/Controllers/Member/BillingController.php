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
        return response()->view('seating.pdf.receipt')->with('payment', $payment)->with('charge', $charge);
        //return \PDF::loadView('seating.pdf.receipt')->stream();
    }

    public function getPayments()
    {
        $payments = Sentinel::getUser()->seatpayments;
        return response()->view('account.billing.payments')->with('payments', $payments);
    }

    public function getPayment($id)
    {
        $seatpayment = \LANMS\SeatPayment::where('user_id', \Sentinel::getUser()->id)->find($id);
        if (is_null($seatpayment)) {
            abort(403);
        }
        $charge = \Stripe::charges()->find($seatpayment->stripecharge);
        $card = [];
        if($charge['source']) {
            $card = $charge['source'];
        } elseif ($charge['payment_method_details']) {
            $card = $charge['payment_method_details']['card'];
        }
        return response()->view('account.billing.payment')->with('seatpayment', $seatpayment)->with('charge', $charge)->with('card', $card);
    }

    public function getCharges()
    {
        $stripe_customer = Sentinel::getUser()->stripe_customer;

        if ($stripe_customer) {
            $charges    = \Stripe::charges()->all(array('customer' => $stripe_customer, 'limit' => 100));
            $charges    = $charges['data'];
        } else {
            $charges    = [];
        }
        
        return response()->view('account.billing.charges')->with('charges', $charges);
    }
}
