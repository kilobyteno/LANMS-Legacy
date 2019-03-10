<?php

namespace LANMS\Http\Controllers\Billing;

use Illuminate\Http\Request;
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
        $user       = \Sentinel::getUser();
        $scus       = $user->stripecustomer;

        if ($scus) {
            $sccus = $scus->cus;
            $cards = \Stripe::cards()->all($sccus);
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
        if (\Sentinel::getUser()->addresses->count() == 0) {
            return \Redirect::route('account-billing-card')->with('messagetype', 'warning')
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
        if (\Sentinel::getUser()->addresses->count() == 0) {
            return \Redirect::route('account-billing-card')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }

        $stripecust = \LANMS\StripeCustomer::where('user_id', \Sentinel::getUser()->id)->first();
        
        if ($stripecust == null) {
            $customer = \Stripe::customers()->create([
                'email' => \Sentinel::getUser()->email,
            ]);
            $stripecustomer             = new \LANMS\StripeCustomer;
            $stripecustomer->cus        = $customer['id'];
            $stripecustomer->user_id    = \Sentinel::getUser()->id;
            $stripecustomer->save();

            $stripecust = $stripecustomer;
        }

        $cardNumber         = str_replace(' ', '', $request->get('number'));
        $cardMonthExpiry    = $request->get('expiryMonth');
        $cardCVC            = $request->get('cvc');
        $cardYearExpiry     = $request->get('expiryYear');
        $nameOnCard         = $request->get('name');

        try {
            $token = \Stripe::tokens()->create([
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

            return \Redirect::route('account-billing-card-create')->with('messagetype', 'danger')
                                ->with('message', trans('seating.alert.carderror').': '.$message);
        }

        try {
            \Stripe::cards()->create($stripecust->cus, $token['id']);
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

        return \Redirect::route('account-billing-card')->with('messagetype', 'success')
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
        $user       = \Sentinel::getUser();
        $scus       = $user->stripecustomer;
        if ($scus) {
            $sccus = $scus->cus;
            $cards = \Stripe::cards()->delete($scus->cus, $id);
            return \Redirect::route('account-billing-card')->with('messagetype', 'success')
                                ->with('message', trans('user.account.billing.card.alert.deleted'));
        } else {
            abort(403);
        }
    }
}
