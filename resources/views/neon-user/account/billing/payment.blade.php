@extends('layouts.main')
@section('title', 'Payment #'.$seatpayment->id.' - Billing')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Payment <small>#{{ $seatpayment->id }}</small></h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li>Billing</li>
				<li><a href="{{ route('account-billing-payments') }}">Payments</a></li>
				<li class="active"><strong>Payment #{{ $seatpayment->id }}</strong></li>
			</ol>

			<div class="row">
				<div class="col-md-6">
					
					<div class='card-wrapper'></div>
					<form role="form" id="payment-form" method="post" action="">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group @if($errors->has('number')) has-error @endif">
									<label for="number">CARD NUMBER</label>
									<div class="input-group">
										<input type="tel" class="form-control" name="number" placeholder="Valid Card Number" required autofocus value="{{ (old('number')) ? old('number') : '' }}" autocomplete="off" />
										<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-md-6">
								<div class="form-group @if($errors->has('expiry')) has-error @endif">
									<label for="expiry">EXP. MONTH / YEAR</label>
									<input type="tel" class="form-control" name="expiry" placeholder="MM" required value="{{ (old('expiry')) ? old('expiry') : '' }}" autocomplete="off" />
								</div>
							</div>
							<div class="col-xs-6 col-md-6 pull-right">
								<div class="form-group @if($errors->has('cvc')) has-error @endif">
									<label for="cvc">CV CODE</label>
									<input type="tel" class="form-control" name="cvc" placeholder="CVC" required value="{{ (old('cvc')) ? old('cvc') : '' }}" autocomplete="off" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn btn-success btn-lg btn-block" type="submit" id="pay"><i class='fa fa-money'></i> Pay Now</button>
								<br />
								<div class="alert alert-info hidden" id="processing">
									<i class='fa fa-circle-o-notch fa-spin'></i> Processing Payment
								</div>
							</div>
						</div>
						@if(count($errors->all()) > 0)
							<br>
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>
								@endforeach
							</div>
						@endif
					</form>

				</div>
				<div class="col-md-6">
					<table class="table">
						<thead>
							<th>Date</th>
							<th>Amount</th>
							<th>Currency</th>
							<th>number</th>
							<th>Card Exp.</th>
							<th>Paid</th>
							<th>Refunded</th>
							<th>Status</th>
							<th>Linked to reservation</th>
						</thead>
						<tbody>
							<tr>
								<td>{{ date(User::getUserDateFormat(), $charge['created']) .' at '. date(User::getUserTimeFormat(), $charge['created']) }}</td>
								<td>{{ substr($charge['amount'], 0, -2) }}</td>
								<td>{{ strtoupper($charge['currency']) }}</td>
								<td><em>xxxx xxxx xxxx</em> {{ $charge['source']['last4'] }}</td>
								<td>{{ $charge['source']['exp_month'] }} / {{ $charge['source']['exp_year'] }}</td>
								<td>{{ ($charge['paid'] ? "Yes" : "No") }}</td>
								<td>{{ ($charge['refunded'] ? "Yes - ".substr($charge['amount_refunded'], 0, -2)." ".strtoupper($charge['currency']) : "No") }}</td>
								<td>
									@if($charge['failure_message'])
										<a href="javascript:void(0);" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $charge['failure_message'] }}" data-original-title="Failure Message">Failure</a>
									@else
										{{ ucfirst($charge['status']) }}
									@endif
								</td>
								<td>
									<?php $charge = \LANMS\SeatPayment::where('stripecharge', '=', $charge['id'])->with('reservation')->first(); ?>
									@if($charge)
										#{{ $charge->reservation->id }} - {{ $charge->reservation->year }}
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
	</div>
</div>
@stop
@section('javascript')
	<script src="{{ Theme::url('js/jquery.card.js') }}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#payment-form').card({
				// a selector or DOM element for the container
				// where you want the card to appear
				container: '.card-wrapper', // *required*
				cardType: 'visa',

				// all of the other options from above
			});
		});
	</script>
@stop