<?php

namespace LANMS\Http\Controllers\Billing;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Http\Controllers\Controller;
use LANMS\Info;
use LANMS\User;

class InvoiceController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!config('services.stripe.key'), 403);
        $stripe_customer = Sentinel::getUser()->stripe_customer;

        if ($stripe_customer) {
            $invoices = Stripe::invoices()->all(array('customer' => $stripe_customer, 'limit' => 100));
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
        abort_if(!config('services.stripe.key'), 403);
        if (!Sentinel::getUser()->hasAddress()) {
            return Redirect::route('account-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', __('user.account.billing.alert.noaddress'));
        }
        $invoice = Stripe::invoices()->find($id);
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
        abort_if(!config('services.stripe.key'), 403);
        if (!Sentinel::getUser()->hasAddress()) {
            return Redirect::route('account-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', __('user.account.billing.alert.noaddress'));
        }
        $invoice = Stripe::invoices()->find($id);
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
        abort_if(!config('services.stripe.key'), 403);
        if (!Sentinel::getUser()->hasAddress()) {
            return Redirect::route('account-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', __('user.account.billing.alert.noaddress'));
        }
        $invoice = Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        abort_unless(!$invoice['paid'], 403);

        $stripe_customer = Sentinel::getUser()->stripe_customer;
        $customer = Stripe::customers()->find($stripe_customer);

        if ($customer['sources']['total_count'] == 0) {
            return Redirect::route('account-billing-invoice-view', $invoice['id'])->with('messagetype', 'warning')
                                ->with('message', __('user.account.billing.invoice.alert.nocards', ['url' => route('account-billing-card-create')]));
        }
        try {
            Stripe::invoices()->pay($id);
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('account-billing-invoice-view', $invoice['id'])->with('messagetype', 'danger')
                                ->with('message', $message);
        } catch (\Cartalyst\Stripe\Exception\InvalidRequestException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('account-billing-invoice-view', $invoice['id'])->with('messagetype', 'danger')
                                ->with('message', $message);
        }
        return Redirect::route('account-billing-invoice-view', $invoice['id'])->with('messagetype', 'success')
                                ->with('message', __('user.account.billing.invoice.alert.paid'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        abort_if(!config('services.stripe.key'), 403);
        $invoices = Stripe::invoices()->all(array('limit' => 100));
        return view('billing.invoice.index')->withInvoices($invoices['data']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!config('services.stripe.key'), 403);
        if (!Info::getContent('address_city') || !Info::getContent('address_country') || !Info::getContent('address_county') || !Info::getContent('address_postal_code') || !Info::getContent('address_street')) {
            return Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', 'One or more address fields in Info is missing. You need this to be able to send invoices! <a href="'.route("admin-info").'" class="alert-link">Click here to fix it!</a>');
        }
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
        abort_if(!config('services.stripe.key'), 403);
        if (!Info::getContent('address_city') || !Info::getContent('address_country') || !Info::getContent('address_county') || !Info::getContent('address_postal_code') || !Info::getContent('address_street')) {
            return Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', 'One or more address fields in Info is missing. You need this to be able to send invoices! <a href="'.route("admin-info").'" class="alert-link">Click here to fix it!</a>');
        }
        $user = User::find($request->get('user_id'));
        if (is_null($user)) {
            return Redirect::route('admin-billing-invoice-create')->with('messagetype', 'warning')
                                ->with('message', 'User not found.');
        }
        if (!$user->hasAddress()) {
            return Redirect::route('admin-billing-invoice-create')->with('messagetype', 'warning')
                                ->with('message', __('user.account.billing.alert.noaddress'));
        }

        $stripe_customer = Sentinel::getUser()->stripe_customer;

        try {
            for ($i=0; $i < count($request->get('description')); $i++) {
                Stripe::invoiceItems()->create($stripe_customer, [
                    'description' => $request->get('description')[$i],
                    'unit_amount' => ($request->get('price')[$i]*100),
                    'quantity' => $request->get('qty')[$i],
                    'currency' => strtolower(\Setting::get('MAIN_CURRENCY')),
                ]);
            }
            $invoice = Stripe::invoices()->create($stripe_customer, [
                'billing' => 'send_invoice',
                'days_until_due' => $request->get('days_until_due'),
                'description' => $request->get('memo'),
                'tax_percent' => $request->get('tax_percent'),
            ]);
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', $message);
        }
        return Redirect::route('admin-billing-invoice')->with('messagetype', 'success')
                                ->with('message', 'Invoice has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!config('services.stripe.key'), 403);
        try {
            $invoice = Stripe::invoices()->find($id);
            $events = Stripe::events()->all(['object_id' => $id]);
            $events = $events['data'];
        } catch (\Cartalyst\Stripe\Exception\NotFoundException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', $message);
        }
        $user = User::where('stripe_customer', $invoice['customer'])->first();
        return view('billing.invoice.show')->withInvoice($invoice)->withUser($user)->withEvents($events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!config('services.stripe.key'), 403);
        $invoice = Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        if ($invoice['status'] != 'draft') {
            return Redirect::route('admin-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', 'You can\'t edit this invoice after it has been sent.');
        }
        $user = User::where('stripe_customer', $invoice['customer'])->first();
        return view('billing.invoice.edit')->withInvoice($invoice)->withUser($user);
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
        abort_if(!config('services.stripe.key'), 403);
        $user = User::find($request->get('user_id'));
        if (!$user) {
            return Redirect::route('admin-billing-invoice-create')->with('messagetype', 'warning')
                                ->with('message', 'User not found.');
        }
        if (!$user->hasAddress) {
            return Redirect::route('admin-billing-invoice-create')->with('messagetype', 'warning')
                                ->with('message', __('user.account.billing.alert.noaddress'));
        }

        $stripe_customer = Sentinel::getUser()->stripe_customer;

        try {
            $invoice = \Stripe::invoices()->find($id);
            if ($invoice['status'] != 'draft') {
                return Redirect::route('admin-billing-invoice')->with('messagetype', 'warning')
                                    ->with('message', 'You can\'t edit this invoice after it has been sent.');
            }
            $ii = array();
            foreach ($invoice['lines']['data'] as $line) {
                array_push($ii, $line['id']);
            }
            $invoice = \Stripe::invoices()->update($id, [
                'description' => $request->get('memo'),
                'tax_percent' => $request->get('tax_percent'),
            ]);
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', 'I: '.$message);
        }
        try {
            for ($i=0; $i < count($request->get('description')); $i++) {
                if (!is_null($request->get('invoiceitem')[$i])) {
                    $invoiceitem = $request->get('invoiceitem')[$i];
                    $pos = array_search($invoiceitem, $ii); // Find Invoice Item in array
                    unset($ii[$pos]); // Remove Invoice Item from array
                    \Stripe::invoiceItems()->update($invoiceitem, [
                        'description' => $request->get('description')[$i],
                        'unit_amount' => ($request->get('price')[$i]*100),
                        'quantity' => $request->get('qty')[$i],
                    ]);
                } elseif (!is_null($request->get('description')[$i]) && !is_null($request->get('price')[$i]) && !is_null($request->get('qty')[$i])) {
                    \Stripe::invoiceItems()->create($stripecust->cus, [
                        'description' => $request->get('description')[$i],
                        'unit_amount' => ($request->get('price')[$i]*100),
                        'quantity' => $request->get('qty')[$i],
                        'currency' => strtolower(\Setting::get('MAIN_CURRENCY')),
                    ]);
                }
            }
            if (count($ii) > 0) { // Check if there is any lines left to delete
                foreach ($ii as $id) {
                     \Stripe::invoiceItems()->delete($id); // delete lines left
                }
            }
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();

            return Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', 'II: '.$message);
        }
        return Redirect::route('admin-billing-invoice-edit', $invoice['id'])->with('messagetype', 'success')
                                ->with('message', 'Invoice has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!config('services.stripe.key'), 403);
        \Stripe::invoices()->delete($id);
        return Redirect::route('admin-billing-invoice')->with('messagetype', 'success')
                                ->with('message', 'Invoice has been voided.');
    }

    public function finalize($id)
    {
        abort_if(!config('services.stripe.key'), 403);
        \Stripe::invoices()->finalize($id);
        return Redirect::route('admin-billing-invoice-show', $id)->with('messagetype', 'success')
                                ->with('message', 'Invoice has been finalized and sent.');
    }
}
