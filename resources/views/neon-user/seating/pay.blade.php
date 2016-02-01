@extends('layouts.main')
@section('title', 'Pay Reservation - '.$currentseat->name)
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/creditcard.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Pay Reservation - {{ $currentseat->name }}</h1>

			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li><a href="{{ route('seating') }}">Seating</a></li>
				<li class="active"><strong>Pay Reservation - {{ $currentseat->name }}</strong></li>
			</ol>

			<div class="row">	
				<div class="col-md-8">

					@if(Setting::get('SEATING_SHOW_MAP'))
						@include('seating.seatmap')
					@else
						<h2>Seatmap is not available at this moment!</h2>
						<p>Please check back later...</p>
					@endif

				</div>
				<div class="col-md-4">
					<!-- CREDIT CARD FORM STARTS HERE -->
					<div class="panel panel-default credit-card-box">
						<div class="panel-heading display-table" >
							<div class="row display-tr" >
								<h3 class="panel-title display-td">Payment Details</h3>
								<div class="display-td" >                            
									<img class="img-responsive pull-right" src="{{ Theme::url('images/creditcards.png') }}">
								</div>
							</div>                    
						</div>
						<div class="panel-body">
							<form role="form" id="payment-form">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="cardNumber">CARD NUMBER</label>
											<div class="input-group">
												<input 
													type="tel"
													class="form-control"
													name="cardNumber"
													placeholder="Valid Card Number"
													autocomplete="cc-number"
													required autofocus 
												/>
												<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
											</div>
										</div>                            
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4 col-md-4">
										<div class="form-group">
											<label for="cardExpiry">EXP. MONTH</label>
											<input 
												type="tel" 
												class="form-control" 
												name="cardExpiry"
												placeholder="MM"
												required 
											/>
										</div>
									</div>
									<div class="col-xs-4 col-md-4">
										<div class="form-group">
											<label for="cardExpiry">EXP. YEAR</label>
											<input 
												type="tel" 
												class="form-control" 
												name="cardExpiry"
												placeholder="YY"
												required 
											/>
										</div>
									</div>
									<div class="col-xs-4 col-md-4 pull-right">
										<div class="form-group">
											<label for="cardCVC">CV CODE</label>
											<input 
												type="tel" 
												class="form-control"
												name="cardCVC"
												placeholder="CVC"
												autocomplete="cc-csc"
												required
											/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<button class="btn btn-success btn-lg btn-block" type="submit">Charge</button>
									</div>
								</div>
								<div class="row" style="display:none;">
									<div class="col-xs-12">
										<p class="payment-errors"></p>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- CREDIT CARD FORM ENDS HERE -->
				</div>
		</div>
	</div>
</div>
@stop