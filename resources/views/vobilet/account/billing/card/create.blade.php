@extends('layouts.main')
@section('title', __('user.account.billing.card.create.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ __('user.account.billing.card.create.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ __('user.account.billing.title') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('account-billing-card') }}">{{ __('user.account.billing.card.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('user.account.billing.card.create.title') }}</li>
        </ol>
    </div>
	<div class="row justify-content-md-center">
		<div class="col-xl-5">
			<div class="card-wrapper" style="margin-bottom: 10px"></div>
			<div class="card mt-5">
				<div class="card-body">
					<form role="form" id="payment-form" method="post" action="{{ route('account-billing-card-store') }}">
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
								<button class="btn btn-success btn-lg btn-block" type="submit"><i class="fas fa-save"></i> {{ __('global.savechanges') }}</button>
							</div>
						</div>
						@if(count($errors->all()) > 0)
							<div class="alert alert-danger mt-2">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>
								@endforeach
							</div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section("javascript")
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