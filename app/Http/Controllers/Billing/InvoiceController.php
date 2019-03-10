<?php

namespace LANMS\Http\Controllers\Billing;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class InvoiceController extends Controller
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
            $invoices = \Stripe::invoices()->all(array('customer' => $sccus, 'limit' => 100));
            $invoices = $invoices['data'];
        } else {
            $invoices = [];
        }
        return view('account.billing.invoice.index')->withInvoices($invoices);
    }

    /**
     * Get the View instance for the invoice.
     *
     * @param  array  $data
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        if (\Sentinel::getUser()->addresses->count() == 0) {
            return \Redirect::route('account-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }
        $invoice = \Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        return view('account.billing.invoice.view')->withInvoice($invoice);
    }

    /**
     * Get the View instance for the invoice.
     *
     * @param  array  $data
     * @return \Illuminate\View\View
     */
    public function pay($id)
    {
        if (\Sentinel::getUser()->addresses->count() == 0) {
            return \Redirect::route('account-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }
        $invoice = \Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        if ($invoice['paid'] == true) {
            abort(403);
        }
        return view('account.billing.invoice.pay')->withInvoice($invoice);
    }

    /**
     * Get the View instance for the invoice.
     *
     * @param  array  $data
     * @return \Illuminate\View\View
     */
    public function charge($id)
    {
        if (\Sentinel::getUser()->addresses->count() == 0) {
            return \Redirect::route('account-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }
        $invoice = \Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        if ($invoice['paid'] == true) {
            abort(403);
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
        $customer = \Stripe::customers()->find($stripecust->cus);
        if ($customer['sources']['total_count'] == 0) {
            return \Redirect::route('account-billing-invoice-view', $invoice['id'])->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.invoice.alert.nocards', ['url' => route('account-billing-card-create')]));
        }

        \Stripe::invoices()->pay($id);
        return \Redirect::route('account-billing-invoice-view', $invoice['id'])->with('messagetype', 'success')
                                ->with('message', trans('user.account.billing.invoice.alert.paid'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $invoices = \Stripe::invoices()->all();
        return view('billing.invoice.index')->withInvoices($invoices['data']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('billing.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \LANMS\User::find($request->get('user_id'));
        if (is_null($user)) {
            return \Redirect::route('admin-billing-invoice-create')->with('messagetype', 'warning')
                                ->with('message', 'User not found.');
        }
        if ($user->addresses->count() == 0) {
            return \Redirect::route('admin-billing-invoice-create')->with('messagetype', 'warning')
                                ->with('message', trans('user.account.billing.alert.noaddress'));
        }
        $stripecust = \LANMS\StripeCustomer::where('user_id', $user->id)->first();
        if ($stripecust == null) {
            $customer = \Stripe::customers()->create([
                'email' => $user->email,
            ]);
            $stripecustomer             = new \LANMS\StripeCustomer;
            $stripecustomer->cus        = $customer['id'];
            $stripecustomer->user_id    = $user->id;
            $stripecustomer->save();

            $stripecust = $stripecustomer;
        }
        try {
            $invoice = \Stripe::invoices()->create($stripecust->cus);
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return \Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', $message);
        }
        return \Redirect::route('admin-billing-invoice-edit', $invoice['id'])->with('messagetype', 'warning')
                                ->with('message', 'Invoice has been created. Please edit it here.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $invoice = \Stripe::invoices()->find($id);
        } catch (\Cartalyst\Stripe\Exception\NotFoundException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return \Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', $message);
        }
        $user = \LANMS\StripeCustomer::where('cus', $invoice['customer'])->first()->user;
        return view('billing.invoice.show')->withInvoice($invoice)->withUser($user);
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
        //
    }
}
