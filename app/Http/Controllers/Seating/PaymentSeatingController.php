<?php

namespace LANMS\Http\Controllers\Seating;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;
use Cartalyst\Stripe\Exception\ServerErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests;
use LANMS\Http\Requests\Seating\PaymentRequest;
use LANMS\SeatPayment;
use LANMS\SeatReservation;
use LANMS\SeatRows;
use LANMS\SeatTicket;
use LANMS\Seats;
use LANMS\StripeCustomer;
use anlutro\LaravelSettings\Facade as Setting;

class PaymentSeatingController extends Controller
{


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
        if ($currentseat == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if ($currentseat->reservationsThisYear->first()) {
            if ($currentseat->reservationsThisYear->first()->payment_id != 0) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.paymentexist'));
            }
            if (Sentinel::getUser()->id <> $currentseat->reservationsThisYear->first()->reservedby->id) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.noreservation'));
            }
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.noreservation'));
        }
        
        $rows = SeatRows::orderBy('sort_order', 'asc')->get();
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
        if ($seat == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if ($seat->reservationsThisYear->first()) {
            if ($seat->reservationsThisYear->first()->payment_id != 0) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.paymentexist'));
            }
            if (Sentinel::getUser()->id <> $seat->reservationsThisYear->first()->reservedby->id) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.noreservation'));
            }
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.noreservation'));
        }

        $stripecust = StripeCustomer::where('user_id', Sentinel::getUser()->id)->first();
        
        if ($stripecust == null) {
            $customer = Stripe::customers()->create([
                'email' => Sentinel::getUser()->email,
            ]);
            $stripecustomer             = new StripeCustomer;
            $stripecustomer->cus        = $customer['id'];
            $stripecustomer->user_id    = Sentinel::getUser()->id;
            $stripecustomer->save();

            $stripecust = $stripecustomer;
        }

        /*$getcards = \Stripe::cards()->all($stripecust->cus);
        $carddata = $getcards['data'];
        dd($carddata);*/

        $cardNumber         = str_replace(' ', '', $request->get('number'));
        $cardMonthExpiry    = $request->get('expiryMonth');
        $cardCVC            = $request->get('cvc');
        $cardYearExpiry     = $request->get('expiryYear');
        $nameOnCard         = $request->get('name');

        try {
            $paymentmethod = Stripe::PaymentMethods()->create([
                'type' => 'card',
                'card' => [
                    'number'    => $cardNumber,
                    'exp_month' => $cardMonthExpiry,
                    'cvc'       => $cardCVC,
                    'exp_year'  => $cardYearExpiry,
                ],
            ]);
        } catch (CardErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', trans('seating.alert.carderror').': '.$message);
        } catch (MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'PM: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        }

        try {
            $token  = Stripe::tokens()->create([
                'card' => [
                    'number'    => $cardNumber,
                    'exp_month' => $cardMonthExpiry,
                    'cvc'       => $cardCVC,
                    'exp_year'  => $cardYearExpiry,
                ],
            ]);
            $card = Stripe::cards()->create($stripecust->cus, $token['id']);
        } catch (CardErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', trans('seating.alert.carderror').': '.$message);
        } catch (MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'C: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        }

        try {
            $customer = Stripe::customers()->update($stripecust->cus, [
                'default_source' => $card['id'],
            ]); // Set the card as default
        } catch (CardErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'SCD: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        } catch (ServerErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'SCD: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        } catch (MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'SCD: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        }

        try {
            $pi = Stripe::PaymentIntents()->create([
                'customer'  => $stripecust->cus,
                'currency'  => Setting::get('SEATING_SEAT_PRICE_CURRENCY'),
                'amount'    => $seat->tickettype->price,
                'payment_method_types' => ['card'],
            ]);
            $pic = Stripe::PaymentIntents()->confirm($pi['id'], [
              'payment_method' => $paymentmethod['id'],
            ]);
        } catch (CardErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'PI: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        } catch (MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'PI: '.$message.'. '.trans('seating.alert.pleasetryagain'));
        }

        if ($pic['status'] != 'succeeded') {
            return Redirect::route('seating-pay', $slug)->with('messagetype', 'danger')
                                ->with('message', 'Failed to confirm payment. '.trans('seating.alert.pleasetryagain'));
        }

        $charge = $pic['charges']['data'][0];

        $reservation                    = $seat->reservationsThisYear->first();
        $reservationid                  = $reservation->id;

        $seatpayment                    = new SeatPayment;
        $seatpayment->stripecharge      = $charge['id'];
        $seatpayment->reservation_id    = $reservationid;
        $seatpayment->user_id           = Sentinel::getUser()->id;
        $seatpayment->save();

        $seatticket                     = new SeatTicket;
        $seatticket->barcode            = mt_rand(1000000000, 2147483647);
        $seatticket->reservation_id     = $reservationid;
        $seatticket->user_id            = Sentinel::getUser()->id;
        $seatticket->year               = \Setting::get('SEATING_YEAR');
        $seatticket->save();

        $reservationchange              = SeatReservation::find($reservationid);
        $reservationchange->status_id   = 1;
        $reservationchange->payment_id  = $seatpayment->id;
        $reservationchange->ticket_id   = $seatticket->id;
        $reservationchange->save();

        return Redirect::route('seating')->with('messagetype', 'success')
                                ->with('message', trans('seating.alert.seatpaid', ['seatname' => $seat->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function paylater($slug)
    {
        $seat = Seats::where('slug', $slug)->first();

        if ($seat == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if ($seat->reservationsThisYear->first()) {
            if ($seat->reservationsThisYear->first()->payment_id != 0) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.paymentexist'));
            }
            if (Sentinel::getUser()->id <> $seat->reservationsThisYear->first()->reservedby->id) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.noreservation'));
            }
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.noreservation'));
        }

        $reservation                    = $seat->reservationsThisYear->first();
        $reservationid                  = $reservation->id;

        $seatticket                     = new SeatTicket;
        $seatticket->barcode            = mt_rand(1000000000, 2147483647);
        $seatticket->reservation_id     = $reservationid;
        $seatticket->user_id            = Sentinel::getUser()->id;
        $seatticket->year               = \Setting::get('SEATING_YEAR');
        $seatticket->save();

        $reservationchange              = SeatReservation::find($reservationid);
        $reservationchange->status_id   = 1;
        $reservationchange->ticket_id   = $seatticket->id;
        $reservationchange->save();

        return Redirect::route('seating')->with('messagetype', 'success')
                                ->with('message', trans('seating.alert.seattemppaid', ['seatname' => $seat->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function changepayment($slug)
    {
        $slug = strtolower($slug); // Just to be sure it is correct
        $seat = Seats::where('slug', $slug)->first();

        if ($seat == null) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatnotfound'));
        }
        if (!Setting::get('SEATING_OPEN')) {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.seatingclosed'));
        }
        if ($seat->reservationsThisYear->first()) {
            if ($seat->reservationsThisYear->first()->payment_id != 0) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.paymentexist'));
            }
            if (Sentinel::getUser()->id <> $seat->reservationsThisYear->first()->reservedby->id) {
                return Redirect::route('seating')->with('messagetype', 'warning')
                                    ->with('message', trans('seating.alert.noreservation'));
            }
        } else {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.noreservation'));
        }

        $reservation                    = $seat->reservationsThisYear->first();
        $reservationid                  = $reservation->id;

        if (SeatReservation::getRealExpireTime($reservationid) == "expired") {
            return Redirect::route('seating')->with('messagetype', 'warning')
                                ->with('message', trans('seating.alert.paymentcantchange'));
        }

        $reservation->ticket->delete(); // Delete Old Ticket

        $reservationchange              = SeatReservation::find($reservationid);
        $reservationchange->status_id   = 2;
        $reservationchange->ticket_id   = 0;
        $reservationchange->save();

        return Redirect::route('seating')->with('messagetype', 'success')
                                ->with('message', trans('seating.alert.youcanchangepayment'));
    }
}
