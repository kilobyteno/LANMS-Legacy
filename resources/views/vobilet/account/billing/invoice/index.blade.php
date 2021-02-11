@extends('layouts.main')
@section('title', __('user.account.billing.invoice.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ __('user.account.billing.invoice.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ __('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('user.account.billing.invoice.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(!Sentinel::getUser()->hasAddress())
                <div class="alert alert-warning" role="alert"> <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> {!! __('seating.alert.noaddress', ['url' => route('user-profile-edit', Sentinel::getUser()->username)]) !!}</div>
            @endif
            <div class="card">
                @if(count($invoices) == 0)
                    <div class="card-body">
                        <p><em>{{ __('global.nodata') }}</em></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <th>{{ __('user.account.billing.invoice.title') }} #</th>
                                <th>{{ __('global.date') }}</th>
                                <th>{{ __('global.payment.amount') }}</th>
                                <th>{{ __('global.payment.duedate') }}</th>
                                <th>{{ __('global.payment.paid') }}</th>
                                <th>{{ __('global.status') }}</th>
                                <th>{{ __('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice['number'] }}</td>
                                        <td>{{ ucfirst(\Carbon::parse($invoice['date'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ moneyFormat(floatval($invoice['total']/100), strtoupper($invoice['currency'])) }}</td>
                                        <td>@if(\Carbon::parse($invoice['due_date'])->isPast() && !$invoice['paid'])<span class="badge badge-danger">{{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LL')) }}</span> @else {{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LL')) }}@endif</td>
                                        <td>@if($invoice['status']=='draft') - @else <span @if(!$invoice['paid']) class="badge badge-danger" @elseif($invoice['paid']) class="badge badge-success" @endif>{{ ($invoice['paid'] ? __('global.yes') : __('global.no')) }}</span>@endif</td>
                                        <td>{{ __('user.account.billing.invoice.status.'.$invoice['status']) }}</td>
                                        <td>
                                            <a href="{{ route('account-billing-invoice-view', $invoice['id']) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> {{ __('global.view') }}</a>
                                            @if(!$invoice['paid'] && $invoice['status'] != 'draft')
                                                <a type="button" class="btn btn-sm btn-success text-white" href="{{ route('account-billing-invoice-pay', $invoice['id']) }}"><i class="fas fa-shopping-cart"></i> {{ __('user.account.billing.invoice.payinvoice') }}</a>
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