@extends('layouts.main')
@section('title', trans('user.account.billing.charges.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.account.billing.charges.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.charges.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <div class="card">
                @if(count($charges) == 0)
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
                                <th>{{ trans('global.payment.cardnumber') }}</th>
                                <th>{{ trans('global.payment.cardexp') }}</th>
                                <th>{{ trans('global.payment.paid') }}</th>
                                <th>{{ trans('global.payment.refunded') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($charges as $charge)
                                    <tr>
                                        <td>{{ ucfirst(\Carbon::parse($charge['created'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ substr($charge['amount'], 0, -2) }}</td>
                                        <td>{{ strtoupper($charge['currency']) }}</td>
                                        <td>&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; {{ $charge['source']['last4'] }}</td>
                                        <td>{{ $charge['source']['exp_month'] }} / {{ $charge['source']['exp_year'] }}</td>
                                        <td>{{ ($charge['paid'] ? trans('global.yes') : trans('global.no')) }}</td>
                                        <td>{{ ($charge['refunded'] ? trans('global.yes')." - ".substr($charge['amount_refunded'], 0, -2)." ".strtoupper($charge['currency']) : trans('global.no')) }}</td>
                                        <td>
                                            @if($charge['failure_message'])
                                                <a href="javascript:void(0);" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $charge['failure_message'] }}" data-original-title="{{ trans('global.failure') }} {{ trans('global.payment.message') }}">{{ trans('global.payment.failure') }}</a>
                                            @else
                                                {{ ucfirst($charge['status']) }}
                                            @endif
                                        </td>
                                        <td>
                                            <?php $seatpayment = \LANMS\SeatPayment::where('stripecharge', '=', $charge['id'])->first(); ?>
                                            @if($seatpayment)
                                                <a href="{{ route('account-billing-payment', $seatpayment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ trans('global.view') }}</a>
                                            @else
                                                <em>N/A</em>
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