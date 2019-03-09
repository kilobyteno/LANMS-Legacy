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
        $invoice = \Stripe::invoices()->find($id);
        abort_unless($invoice, 404);
        if ($invoice['paid'] == true) {
            abort(403);
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
        //
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
