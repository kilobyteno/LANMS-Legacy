<?php

namespace LANMS\Http\Controllers\Billing;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\ServerErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\Seating\PaymentRequest;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stripe_customer = Sentinel::getUser()->stripe_customer;

        if ($stripe_customer) {
            $cards = Stripe::cards()->all($stripe_customer);
            $cards = $cards['data'];
        } else {
            $cards = [];
        }
        return view('account.billing.card.index')->withCards($cards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Sentinel::getUser()->addresses->count() == 0) {
            return Redirect::route('account-billing-card')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }
        return view('account.billing.card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $user = Sentinel::getUser();
        if ($user->addresses->count() == 0) {
            return Redirect::route('account-billing-card')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }

        $stripe_customer = $user->stripe_customer;

        $cardNumber         = str_replace(' ', '', $request->get('number'));
        $cardMonthExpiry    = $request->get('expiryMonth');
        $cardCVC            = $request->get('cvc');
        $cardYearExpiry     = $request->get('expiryYear');
        $nameOnCard         = $request->get('name');

        try {
            $token = Stripe::tokens()->create([
                'card' => [
                    'number'    => $cardNumber,
                    'exp_month' => $cardMonthExpiry,
                    'cvc'       => $cardCVC,
                    'exp_year'  => $cardYearExpiry,
                    'name'      => $nameOnCard,
                ],
            ]);
        } catch (CardErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('account-billing-card-create')->with('messagetype', 'danger')
                                ->with('message', trans('seating.alert.carderror').': '.$message);
        }

        try {
            Stripe::cards()->create($stripe_customer, $token['id']);
        } catch (CardErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('account-billing-card-create')->with('messagetype', 'danger')
                                ->with('message', $message.'. '.trans('seating.alert.pleasetryagain'));
        } catch (ServerErrorException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('account-billing-card-create')->with('messagetype', 'danger')
                                ->with('message', $message.'. '.trans('seating.alert.pleasetryagain'));
        }

        return Redirect::route('account-billing-card')->with('messagetype', 'success')
                                ->with('message', trans('user.account.billing.card.alert.added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stripe_customer = Sentinel::getUser()->stripe_customer;
        abort_unless($stripe_customer, 403);

        $cards = Stripe::cards()->delete($stripe_customer, $id);
        return Redirect::route('account-billing-card')->with('messagetype', 'success')
                            ->with('message', trans('user.account.billing.card.alert.deleted'));
    }
}
