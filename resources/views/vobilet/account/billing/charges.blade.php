@extends('layouts.main')
@section('title', __('user.account.billing.charges.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ __('user.account.billing.charges.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ __('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('user.account.billing.charges.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <div class="card">
                @if(count($charges) == 0)
                    <div class="card-body">
                        <p><em>{{ __('global.nodata') }}</em></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <th>{{ __('global.date') }}</th>
                                <th>{{ __('global.payment.amount') }}</th>
                                <th>{{ __('global.payment.cardnumber') }}</th>
                                <th>{{ __('global.payment.cardexp') }}</th>
                                <th>{{ __('global.payment.paid') }}</th>
                                <th>{{ __('global.payment.refunded') }}</th>
                                <th>{{ __('global.status') }}</th>
                                <th>{{ __('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($charges as $charge)
                                    <tr>
                                        <td>{{ ucfirst(\Carbon::parse($charge['created'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ moneyFormat(floatval($charge['amount']/100), strtoupper($charge['currency'])) }}</td>
                                        <td>&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; {{ $charge['payment_method_details']['card']['last4'] }}</td>
                                        <td>{{ $charge['payment_method_details']['card']['exp_month'] }} / {{ $charge['payment_method_details']['card']['exp_year'] }}</td>
                                        <td>{{ ($charge['paid'] ? __('global.yes') : __('global.no')) }}</td>
                                        <td>{{ ($charge['refunded'] ? __('global.yes')." - ".substr($charge['amount_refunded'], 0, -2)." ".strtoupper($charge['currency']) : __('global.no')) }}</td>
                                        <td>
                                            @if($charge['failure_message'])
                                                <a href="javascript:void(0);" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $charge['failure_message'] }}" data-original-title="{{ __('global.failure') }} {{ __('global.payment.message') }}">{{ __('global.payment.failure') }}</a>
                                            @else
                                                {{ ucfirst($charge['status']) }}
                                            @endif
                                        </td>
                                        <td>
                                            <?php $seatpayment = \LANMS\SeatPayment::where('stripecharge', '=', $charge['id'])->first(); ?>
                                            @if($seatpayment)
                                                <a href="{{ route('account-billing-payment', $seatpayment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ __('global.view') }}</a>
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