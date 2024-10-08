@extends('layouts.main')
@section('title', __('user.account.billing.payments.payment.title').' #'.$seatpayment->id)
@section('content')
<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ __('user.account.billing.payments.payment.title') }} #{{ $seatpayment->id }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ __('user.account.billing.title') }}</li>
            <li class="breadcrumb-item">{{ __('user.account.billing.payments.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('user.account.billing.payments.payment.title') }} #{{ $seatpayment->id }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-4">
            
            <div class="card-wrapper" data-jp-card-initialized="true">
               <div class="jp-card-container">
                  <div class="jp-card @if(in_array(strtolower($card['brand']), array('elo', 'visa', 'visaelectron', 'mastercard', 'maestro', 'amex', 'discover', 'dinersclub', 'dankkort', 'jcb'))){{ 'jp-card-'.strtolower($card['brand']).' jp-card-identified' }}@endif">
                     <div class="jp-card-front">
                        <div class="jp-card-logo jp-card-elo">
                           <div class="e">e</div>
                           <div class="l">l</div>
                           <div class="o">o</div>
                        </div>
                        <div class="jp-card-logo jp-card-visa">Visa</div>
                        <div class="jp-card-logo jp-card-visaelectron">
                           Visa
                           <div class="elec">Electron</div>
                        </div>
                        <div class="jp-card-logo jp-card-mastercard">Mastercard</div>
                        <div class="jp-card-logo jp-card-maestro">Maestro</div>
                        <div class="jp-card-logo jp-card-amex"></div>
                        <div class="jp-card-logo jp-card-discover">discover</div>
                        <div class="jp-card-logo jp-card-dinersclub"></div>
                        <div class="jp-card-logo jp-card-dankort">
                           <div class="dk">
                              <div class="d"></div>
                              <div class="k"></div>
                           </div>
                        </div>
                        <div class="jp-card-logo jp-card-jcb">
                           <div class="j">J</div>
                           <div class="c">C</div>
                           <div class="b">B</div>
                        </div>
                        <div class="jp-card-lower">
                           <div class="jp-card-shiny"></div>
                           <div class="jp-card-cvc jp-card-display">&#8226;&#8226;&#8226;</div>
                           <div class="jp-card-number jp-card-display jp-card-invalid">&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; {{ $card['last4'] }}</div>
                           <div class="jp-card-name jp-card-display">{{ $card['name'] ?? '' }}</div>
                           <div class="jp-card-expiry jp-card-display" data-before="month/year" data-after="valid
                              thru">{{ $card['exp_month'] }}/{{ $card['exp_year'] }}</div>
                        </div>
                     </div>
                     <div class="jp-card-back">
                        <div class="jp-card-bar"></div>
                        <div class="jp-card-cvc jp-card-display">&#8226;&#8226;&#8226;</div>
                        <div class="jp-card-shiny"></div>
                     </div>
                  </div>
               </div>
            </div>

        </div>
        <div class="col-md-4">
            <h3>{{ __('user.account.billing.payments.payment.title') }} <a href="{{ route('account-billing-receipt', $seatpayment->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-print"></i> {{ __('user.account.billing.payments.payment.downloadreceipt') }}</a></h3>
            <hr style="margin-top: 0">
            <p><strong>{{ __('global.date') }}:</strong> {{ ucfirst(\Carbon::parse($charge['created'])->isoFormat('LLLL')) }}</p>
            <p><strong>{{ __('global.payment.amount') }}:</strong> {{ moneyFormat(floatval($charge['amount']/100), strtoupper($charge['currency'])) }}</p>
            <p><strong>{{ __('global.payment.paid') }}:</strong> {{ ($charge['paid'] ? __('global.yes') : __('global.no')) }}</p>
            <p><strong>{{ __('global.payment.refunded') }}:</strong> {{ ($charge['refunded'] ? __('global.yes')." - ".substr($charge['amount_refunded'], 0, -2)." ".strtoupper($charge['currency']) : __('global.no')) }}</p>
            <p>
                <strong>{{ __('global.status') }}:</strong>
                @if($charge['failure_message'])
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $charge['failure_message'] }}" data-original-title="{{ __('global.failure') }} {{ __('global.payment.message') }}">{{ __('global.payment.failure') }}</a>
                @else
                    {{ __('global.payment.'.$charge['status']) }}
                @endif
            </p>
        </div>
        <div class="col-md-4">
            <?php $payment = \LANMS\SeatPayment::where('stripecharge', '=', $charge['id'])->with('reservation')->first(); ?>
            @if($payment->reservation)
              <h3>{{ __('user.account.reservations.reservation.title') }} <a href="{{ route('account-reservation-view', $payment->reservation->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ __('global.view') }} {{ __('user.account.reservations.reservation.title') }}</a></h3>
              <hr style="margin-top: 0">
            @endif
            @if($charge)
                <p><strong>ID:</strong> {{ $payment->reservation->id }}</p>
                <p><strong>{{ __('global.year') }}:</strong> {{ $payment->reservation->year }}</p>
                <p><strong>{{ __('global.seat') }}:</strong> {{ $payment->reservation->seat->name }}</p>
                <p><strong>{{ __('global.reservedfor') }}:</strong> {{ User::getFullnameAndNicknameByID($payment->reservation->reservedfor->id) }}</p>
                <p><strong>{{ __('global.reservedby') }}:</strong> {{ User::getFullnameAndNicknameByID($payment->reservation->reservedby->id) }}</p>
            @else
                <em>N/A</em>
            @endif
            
        </div>
    </div>
</div>
@stop
@section("javascript")
    <script src="{{ Theme::url('js/vendors/jquery.card.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('#payment-form').card({
                container: '.card-wrapper'
            });
        });
    </script>
@stop