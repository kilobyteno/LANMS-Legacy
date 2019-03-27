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
        $invoices = \Stripe::invoices()->all(array('limit' => 100));
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
            for ($i=0; $i < count($request->get('description')); $i++) {
                \Stripe::invoiceItems()->create($stripecust->cus, [
                    'description' => $request->get('description')[$i],
                    'unit_amount' => ($request->get('price')[$i]*100),
                    'quantity' => $request->get('qty')[$i],
                    'currency' => strtolower(\Setting::get('SEATING_SEAT_PRICE_CURRENCY')),
                ]);
            }
            $invoice = \Stripe::invoices()->create($stripecust->cus, [
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

            return \Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', $message);
        }
        return \Redirect::route('admin-billing-invoice')->with('messagetype', 'success')
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
        try {
            $invoice = \Stripe::invoices()->find($id);
            $events = \Stripe::events()->all(['object_id' => $id]);
            $events = $events['data'];
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
        $stripecustomer = \LANMS\StripeCustomer::where('cus', $invoice['customer'])->first();
        $user = null;
        if (!is_null($stripecustomer)) {
            $user = \LANMS\User::find($stripecustomer->user_id);
        }
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
        $invoice = \Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        if ($invoice['status'] != 'draft') {
            return \Redirect::route('admin-billing-invoice')->with('messagetype', 'warning')
                                ->with('message', 'You can\'t edit this invoice after it has been sent.');
        }
        $stripecustomer = \LANMS\StripeCustomer::where('cus', $invoice['customer'])->first();
        $user = null;
        if (!is_null($stripecustomer)) {
            $user = \LANMS\User::find($stripecustomer->user_id);
        }
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
            $invoice = \Stripe::invoices()->find($id);
            if ($invoice['status'] != 'draft') {
                return \Redirect::route('admin-billing-invoice')->with('messagetype', 'warning')
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

            return \Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
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
                        'currency' => strtolower(\Setting::get('SEATING_SEAT_PRICE_CURRENCY')),
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

            return \Redirect::route('admin-billing-invoice')->with('messagetype', 'danger')
                                ->with('message', 'II: '.$message);
        }
        return \Redirect::route('admin-billing-invoice-edit', $invoice['id'])->with('messagetype', 'success')
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
        //
    }
}
