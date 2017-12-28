@extends('layouts.main')
@section('title', 'Payment - Billing')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Payments</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li>Billing</li>
				<li><a href="{{ route('account-billing-payments') }}">Payments</a></li>
				<li class="active"><strong>Payment</strong></li>
			</ol>

			<table class="table">
				<thead>
					<th>Date</th>
					<th>Amount</th>
					<th>Currency</th>
					<th>Cardnumber</th>
					<th>Card Exp.</th>
					<th>Paid</th>
					<th>Refunded</th>
					<th>Status</th>
					<th>Linked to reservation</th>
				</thead>
				<tbody>
					<tr>
						<td>{{ date(User::getUserDateFormat(), $seatpayment['created']) .' at '. date(User::getUserTimeFormat(), $seatpayment['created']) }}</td>
						<td>{{ substr($seatpayment['amount'], 0, -2) }}</td>
						<td>{{ strtoupper($seatpayment['currency']) }}</td>
						<td><em>xxxx xxxx xxxx</em> {{ $seatpayment['source']['last4'] }}</td>
						<td>{{ $seatpayment['source']['exp_month'] }} / {{ $seatpayment['source']['exp_year'] }}</td>
						<td>{{ ($seatpayment['paid'] ? "Yes" : "No") }}</td>
						<td>{{ ($seatpayment['refunded'] ? "Yes - ".substr($seatpayment['amount_refunded'], 0, -2)." ".strtoupper($seatpayment['currency']) : "No") }}</td>
						<td>
							@if($seatpayment['failure_message'])
								<a href="javascript:void(0);" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $seatpayment['failure_message'] }}" data-original-title="Failure Message">Failure</a>
							@else
								{{ ucfirst($seatpayment['status']) }}
							@endif
						</td>
						<td>
							<?php $seatpayment = \LANMS\SeatPayment::where('stripecharge', '=', $seatpayment['id'])->with('reservation')->first(); ?>
							@if($seatpayment)
								#{{ $seatpayment->reservation->id }} - {{ $seatpayment->reservation->year }}
							@else
								<em>N/A</em>
							@endif
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop