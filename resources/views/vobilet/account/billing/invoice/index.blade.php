@extends('layouts.main')
@section('title', trans('user.account.billing.invoice.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.account.billing.invoice.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.invoice.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(Sentinel::getUser()->addresses->count() == 0)
                <div class="alert alert-warning" role="alert"> <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> {!! trans('user.account.billing.alert.noaddress', ['url' => route('account-addressbook-create')]) !!}</div>
            @endif
            <div class="card">
                @if(count($invoices) == 0)
                    <div class="card-body">
                        <p><em>{{ trans('global.nodata') }}</em></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <th>{{ trans('user.account.billing.invoice.title') }} #</th>
                                <th>{{ trans('global.date') }}</th>
                                <th>{{ trans('global.payment.amount') }}</th>
                                <th>{{ trans('global.payment.duedate') }}</th>
                                <th>{{ trans('global.payment.paid') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice['number'] }}</td>
                                        <td>{{ ucfirst(\Carbon::parse($invoice['date'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ moneyFormat(floatval($invoice['total']/100), strtoupper($invoice['currency'])) }}</td>
                                        <td>@if(\Carbon::parse($invoice['due_date'])->isPast() && !$invoice['paid'])<span class="badge badge-danger">{{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LL')) }}</span> @else {{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LL')) }}@endif</td>
                                        <td>@if($invoice['status']=='draft') - @else <span @if(!$invoice['paid']) class="badge badge-danger" @elseif($invoice['paid']) class="badge badge-success" @endif>{{ ($invoice['paid'] ? trans('global.yes') : trans('global.no')) }}</span>@endif</td>
                                        <td>{{ trans('user.account.billing.invoice.status.'.$invoice['status']) }}</td>
                                        <td>
                                            <a href="{{ route('account-billing-invoice-view', $invoice['id']) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> {{ trans('global.view') }}</a>
                                            @if(!$invoice['paid'] && $invoice['status'] != 'draft')
                                                <a type="button" class="btn btn-sm btn-success text-white" href="{{ route('account-billing-invoice-pay', $invoice['id']) }}"><i class="fas fa-shopping-cart"></i> {{ trans('user.account.billing.invoice.payinvoice') }}</a>
                                            @endif
                                        </td>
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