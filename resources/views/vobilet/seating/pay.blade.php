@extends('layouts.main')
@section('title', __('seating.pay.title').' - '.$currentseat->name)
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('seating.pay.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('seating') }}">{{ __('header.seating') }}</a></li>
			<li class="breadcrumb-item">{{ __('seating.pay.title') }}</li>
			<li class="breadcrumb-item active" aria-current="page">{{ $currentseat->name }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(!Sentinel::getUser()->hasAddress())
				<div class="alert alert-warning" role="alert"> <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> {!! __('seating.alert.noaddress', ['url' => route('user-profile-edit', Sentinel::getUser()->username)]) !!}</div>
			@endif
			@if(!Setting::get('SEATING_OPEN'))
				<div class="alert alert-info" role="alert"><i class="fas fa-info mr-2" aria-hidden="true"></i> {{ __('seating.alert.closed') }}</div>
			@endif

			<div class="row justify-content-between">	
				<div class="col-md-6">

					@if(Setting::get('SEATING_SHOW_MAP'))
						@include('seating.seatmap')
					@else
						<h2>{{ __('seating.closed') }}</h2>
						<p>{{ __('seating.checklater') }}</p>
					@endif

				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-6">
							<h1 class="text-center"><small class="text-muted">{{ __('seating.pay.tickettype') }}:</small><br>{{ $currentseat->tickettype->name }}</h1>
						</div>
						<div class="col-6">
							<h1 class="text-center"><small class="text-muted">{{ __('seating.pay.price') }}:</small><br>{{ moneyFormat($currentseat->tickettype->price, Setting::get('MAIN_CURRENCY')) }}</h1>
						</div>						
					</div>
					<hr>
					@if($currentseat->tickettype->allow_entrance_payment)
						<a class="btn btn-info btn-lg btn-block" href="{{ route('seating-paylater', $currentseat->slug) }}">{{ __('seating.pay.entrancebutton') }}</a>
						<p class="text-center text-muted"><small><em>{!! __('seating.pay.entrancedesc') !!}</em></small></p>
					@else
						<div class="alert alert-warning mb-5" role="alert"><i class="fas fa-info mr-2" aria-hidden="true"></i> {{ __('seating.alert.entrancepaymentnotallowed') }}</div>
					@endif

					@if($currentseat->tickettype->price != 0)
						<br>
						<h4 class="text-center text-muted"><em>~ {{ __('seating.pay.or') }} ~</em></h4>
						<br>
						<div class="card-wrapper" style="margin-bottom: 10px"></div>
						<div class="card mt-5">
							<div class="card-body">
								<form role="form" id="payment-form" method="post" action="{{ route('seating-charge', $currentseat->slug) }}">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->has('number')) has-error @endif">
												<label for="number">{{ __('seating.pay.card.number') }}</label>
												<div class="input-group">
													<input type="tel" class="form-control" name="number" placeholder="0000 0000 0000 0000" required autofocus value="{{ (old('number')) ? old('number') : '' }}" autocomplete="off" />
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2"><i class="fa fa-credit-card"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group @if($errors->has('expiryMonth')) has-error @endif">
												<label for="expiryMonth">{{ __('seating.pay.card.expmonth') }}</label>
												<input type="tel" class="form-control" name="expiryMonth" placeholder="MM" required value="{{ (old('expiryMonth')) ? old('expiryMonth') : '' }}" autocomplete="off" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group @if($errors->has('expiryYear')) has-error @endif">
												<label for="expiryYear">{{ __('seating.pay.card.expyear') }}</label>
												<input type="tel" class="form-control" name="expiryYear" placeholder="YY" required value="{{ (old('expiryYear')) ? old('expiryYear') : '' }}" autocomplete="off" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group @if($errors->has('cvc')) has-error @endif">
												<label for="cvc">{{ __('seating.pay.card.cvc') }}</label>
												<input type="tel" class="form-control" name="cvc" placeholder="CVC" required value="{{ (old('cvc')) ? old('cvc') : '' }}" autocomplete="off" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->has('name')) has-error @endif">
												<label for="name">{{ __('seating.pay.card.name') }}</label>
												<input type="text" class="form-control" name="name" placeholder="John Doe" required value="{{ (old('name')) ? old('name') : '' }}" autocomplete="off" />
											</div>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button class="btn btn-success btn-lg btn-block" type="submit" id="pay"><i class="fas fa-shopping-cart"></i> {{ __('seating.pay.button') }}</button>
											<div class="alert alert-info d-none" id="processing" style="margin-top: 5px">
												<i class="fas fa-spinner fa-spin"></i> {{ __('seating.pay.processing') }}
											</div>
										</div>
									</div>
									@if(count($errors->all()) > 0)
										<div class="alert alert-danger">
											@foreach ($errors->all() as $error)
												{{ $error }}<br>
											@endforeach
										</div>
									@endif
								</form>
							</div>
						</div>
						<!-- CREDIT CARD FORM ENDS HERE -->
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop
@section("javascript")
	<script type="text/javascript">
		jQuery(function ($) {
			$("#pay").prop("disabled", true);
			$("#payment-form input.form-control").prop("readonly", false);
			$('input').change(function() {
				if($(this).length > 0) {
					$("#pay").prop("disabled", true);
				}
				var anyFieldIsEmpty = $("#payment-form input").filter(function() { return $.trim(this.value).length === 0; }).length > 0;
				console.log(anyFieldIsEmpty);
				if (anyFieldIsEmpty === true) {
					$("#pay").prop("disabled", true);
				} else if (anyFieldIsEmpty === false) {
					$("#pay").prop("disabled", false);
				}
			});
			$('#pay').on('click', function() {
				$("#payment-form input.form-control").prop("readonly", true);
				$("#pay").prop("disabled", true);
				$("#processing").removeClass("d-none");
				$("#payment-form").submit();
			});
		});
	</script>
	
	<script src="{{ Theme::url('js/vendors/jquery.card.js') }}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#payment-form').card({
				container: '.card-wrapper',
				formSelectors: {
					expiryInput: 'input[name="expiryMonth"], input[name="expiryYear"]'
				}
			});
		});
	</script>
@stop