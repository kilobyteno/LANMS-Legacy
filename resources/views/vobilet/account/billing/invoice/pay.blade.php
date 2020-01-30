@extends('layouts.main')
@section('title', trans('user.account.billing.invoice.payinvoice').' #'.$invoice['number'])
@section('content')

<div class="container">
    <div class="page-header d-print-none">
        <h4 class="page-title">{{ trans('user.account.billing.invoice.payinvoice') }} #{{ $invoice['number'] }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('account-billing-invoice') }}">{{ trans('user.account.billing.invoice.title') }}</a></li>
            <li class="breadcrumb-item">#{{ $invoice['number'] }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.invoice.payinvoice') }}</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-8">
        	<div class="card">
				<div class="card-body">
					<div class="row ">
						<div class="col-lg-6">
							<img src="@if(Sentinel::check())@if(Sentinel::getUser()->theme=='dark'){{ Setting::get('WEB_LOGO_LIGHT') }}@else{{ Setting::get('WEB_LOGO_DARK') }}@endif @else {{ Setting::get('WEB_LOGO_DARK') }}@endif" class="header-brand-img d-print-none" alt="{{ Setting::get('WEB_NAME') }}">
							<img src="{{ Setting::get('WEB_LOGO_DARK') }}" class="d-none d-print-inline" style="width:auto;height:auto;max-width:700px;max-height:75px;">
							<address class="mt-2">
								{{ \Setting::get('WEB_NAME') }}<br>
								{{ LANMS\Info::getContent('address_street') }}<br>
								{{ LANMS\Info::getContent('address_postal_code') }}, {{ LANMS\Info::getContent('address_city') }}<br>
								{{ LANMS\Info::getContent('address_county') }}, {{ LANMS\Info::getContent('address_country') }}<br>
								{{ env('MAIL_FROM_ADDRESS') }}
							</address>
						</div>
						<div class="col-lg-6 text-right">
							<p class="h3">{{ trans('user.account.billing.invoice.invoiceto') }}</p>
							<address>
								{{ \Sentinel::getUser()->firstname.' '.\Sentinel::getUser()->lastname }}<br>
								{{ \Sentinel::getUser()->address->address1 ?? '' }} {{ \Sentinel::getUser()->address->address2 ?? '' }}<br>
								{{ \Sentinel::getUser()->address->postalcode ?? '' }} {{ \Sentinel::getUser()->address->city ?? '' }}<br>
								{{ \Sentinel::getUser()->address->county ?? '' }} {{ \Sentinel::getUser()->address->country ?? '' }}<br>
								{{ \Sentinel::getUser()->email }}
							</address>
						</div>
					</div>
					
					<div>
						<p class="mb-1 mt-5"><span class="font-weight-semibold">{{ trans('user.account.billing.invoice.title') }} #:</span> {{ $invoice['number'] }}</p>
						<p class="mb-1"><span class="font-weight-semibold">{{ trans('user.account.billing.invoice.title') }} {{ trans('global.date') }}:</span> {{ ucfirst(\Carbon::parse($invoice['date'])->isoFormat('LLLL')) }}</p>
						<p class="mb-5"><span class="font-weight-semibold">{{ trans('global.payment.duedate') }}:</span> @if(\Carbon::parse($invoice['due_date'])->isPast() && !$invoice['paid'])<span class="text-danger font-weight-bold">{{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LL')) }}</span> @else {{ ucfirst(\Carbon::parse($invoice['due_date'])->isoFormat('LL')) }}@endif</p>
						@if($invoice['custom_fields'])
							@foreach($invoice['custom_fields'] as $customfield)
								<p class="mb-5"><span class="font-weight-semibold">{{ $customfield['name'] }}:</span> {{ $customfield['value'] }}</p>
							@endforeach
						@endif
						<blockquote class="mt-5 mb-5">
							{{ $invoice['description'] }}
						</blockquote>
					</div>
					<div class="table-responsive push">
						<table class="table table-bordered table-hover">
							<tbody>
								<tr class="">
									<th class="text-center" style="width: 5%">#</th>
									<th>{{ trans('user.account.billing.invoice.product') }}</th>
									<th class="text-center" style="width: 5%">{{ trans('user.account.billing.invoice.quantity') }}</th>
									<th class="text-right" style="width: 15%">{{ trans('user.account.billing.invoice.unitprice') }}</th>
									<th class="text-right" style="width: 15%">{{ trans('user.account.billing.invoice.amount') }}</th>
								</tr>
								@foreach($invoice['lines']['data'] as $line)
									<tr>
										<td class="text-center">{{ (array_search($line, $invoice['lines']['data'])+1) }}</td>
										<td><p class="font-w600 mb-1">{{ $line['description'] }}</p></td>
										<td class="text-center">{{ $line['quantity'] }}</td>
										<td class="text-right">{{ moneyFormat(floatval(($line['amount']/100) / $line['quantity']), strtoupper($invoice['currency'])) }}</td>
										<td class="text-right">{{ moneyFormat(floatval($line['amount']/100), strtoupper($invoice['currency'])) }}</td>
									</tr>
								@endforeach
								<tr>
									<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.subtotal') }}</td>
									<td class="text-right">{{ moneyFormat(floatval($invoice['subtotal']/100), strtoupper($invoice['currency'])) }}</td>
								</tr>
								@if($invoice['discount'])
									<tr>
										<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.discount') }}: {{ $invoice['discount']['coupon']['name'] }} ({{ $invoice['discount']['coupon']['percent_off'] }}%)</td>
										<td class="text-right">{{ moneyFormat(floatval(($invoice['subtotal']*($invoice['discount']['coupon']['percent_off']/100))/100), strtoupper($invoice['currency'])) }}</td>
									</tr>
								@endif
								@if($invoice['tax_percent'] != 0)
									<tr>
										<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.taxrate') }}</td>
										<td class="text-right">{{ $invoice['tax_percent'] ?? 0 }}%</td>
									</tr>
									<tr>
										<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.taxdue') }}</td>
										<td class="text-right">{{ moneyFormat(floatval($invoice['tax']/100), strtoupper($invoice['currency'])) }}</td>
									</tr>
								@endif
								<tr>
									<td colspan="4" class="font-weight-bold text-uppercase text-right">{{ trans('user.account.billing.invoice.totaldue') }}</td>
									<td class="font-weight-bold text-right">{{ moneyFormat(floatval($invoice['total']/100), strtoupper($invoice['currency'])) }}</td>
								</tr>
								@if($invoice['status']!='draft')
									<tr>
										<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.amountpaid') }}</td>
										<td class="text-right">{{ moneyFormat(floatval($invoice['amount_paid']/100), strtoupper($invoice['currency'])) }}</td>
									</tr>
									@if(!$invoice['paid'])
										<tr>
											<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.amountremaining') }}</td>
											<td class="text-right">{{ moneyFormat(floatval($invoice['amount_remaining']/100), strtoupper($invoice['currency'])) }}</td>
										</tr>
									@endif
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-primary" role="alert"><i class="fas fa-info-circle"></i> {!! trans('user.account.billing.invoice.explination', ['url' => route('account-billing-card')]) !!}</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<a class="btn btn-success btn-lg btn-block" href="{{ route('account-billing-invoice-charge', $invoice['id']) }}" id="pay"><i class="fas fa-shopping-cart"></i> {{ trans('seating.pay.button') }}</a>
							<div class="alert alert-info d-none" id="processing" style="margin-top: 5px">
								<i class="fas fa-spinner fa-spin"></i> {{ trans('seating.pay.processing') }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section("javascript")
	<script type="text/javascript">
		jQuery(function ($) {
			$('#pay').on('click', function() {
				$("#pay").addClass("d-none");
				$("#processing").removeClass("d-none");
			});
		});
	</script>
@stop