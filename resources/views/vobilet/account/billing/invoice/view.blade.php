@extends('layouts.main')
@section('title', trans('user.account.billing.invoice.title').' #'.$invoice['number'])
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.account.billing.invoice.title') }} #{{ $invoice['number'] }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.invoice.title') }} #{{ $invoice['number'] }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <div class="card">
                @if(count($invoices) == 0)
                    <div class="card-body">
                        <p><em>{{ trans('global.nodata') }}</em></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <th>{{ trans('global.date') }}</th>
                                <th>{{ trans('global.payment.amount') }}</th>
                                <th>{{ trans('global.payment.currency') }}</th>
                                <th>{{ trans('global.payment.duedate') }}</th>
                                <th>{{ trans('global.payment.paid') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ ucfirst(\Carbon::parse($invoice['date'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ substr($invoice['amount_due'], 0, -2) }}</td>
                                        <td>{{ strtoupper($invoice['currency']) }}</td>
                                        <td>{{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ ($invoice['paid'] ? trans('global.yes') : trans('global.no')) }}</td>
                                        <td>{{ trans('user.account.billing.invoice.status.'.$invoice['status']) }}</td>
                                        <td><a href="{{ route('account-billing-invoice-view', $invoice['id']) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ trans('global.view') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop