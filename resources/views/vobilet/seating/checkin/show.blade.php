@extends('layouts.main')
@section('title', __('seating.checkin.title'))
@section('content')

<div class="container">
    <div class="page-header">
		<h4 class="page-title">{{ __('seating.checkin.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('seating') }}">{{ __('header.seating') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('seating-checkin') }}">{{ __('seating.checkin.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $ticket->code }}</li>
		</ol>
	</div>
    <div class="row">
        <div class="col-lg-6">
        	<div class="card">
				<div class="card-body">
					<div class="text-center">
						<img src="{{ Setting::get('WEB_LOGO_DARK') }}" style="max-width:50%;display: inline-block;">
						<h1 class="my-5">{{ __('seating.ticket.title') }}</h1>
					</div>
					<hr>
					<h2 class="text-center">{{ $ticket->user->firstname.' '.$ticket->user->lastname }}<br><small>{{ $ticket->user->username }}</small></h2>
					<br>
					<p>{{ __('pdf.ticket.desc') }}</p>
					<hr>
					<div class="row text-center mt-5">
						<div class="col-12 col-lg-4">
							<h2><strong><small>{{ __('global.type') }}:</small><br>{{ $ticket->reservation->seat->tickettype->name }}</strong></h2>
						</div>
						<div class="col-12 col-lg-4">
							@if(!$ticket->reservation->payment)
								<h2><strong><small>{{ __('global.payment.paid') }}:</small><br><span class="text-danger">{{ __('global.no') }}<br>{{ moneyFormat($ticket->reservation->seat->tickettype->price, Setting::get('MAIN_CURRENCY')) }}</span></strong></h2>
							@else
								<h2><strong><small>{{ __('global.payment.paid') }}:</small><br><span class="text-success">{{ __('global.yes') }}</span></strong></h2>
							@endif
						</div>
						<div class="col-12 col-lg-4">
							<h2><strong><small>{{ __('pdf.ticket.yourseat') }}:</small><br>{{ $ticket->reservation->seat->name }}</strong></h2>
						</div>
					</div>
					<hr>
					<div class="mt-5">
						<img style="display: inline-block;" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($ticket->barcode, "I25", 4, 40) }}" />
						<h4 class="mt-2">{{ $ticket->barcode }}</h4>
					</div>
				</div>
			</div>
        </div>
        <form class="col-lg-6" role="form" method="post" action="{{ route('seating-checkin-verifycode') }}">
			<div class="alert alert-primary" role="alert">
				<i class="fas fa-info mr-2" aria-hidden="true"></i>{{ __('user.account.verifyphone.alert.info') }}
			</div>
			<div class="card">
				<div class="card-body">
					<div class="form-group @if ($errors->has('code')) has-error @endif">
						<label class="form-label">{{ __('user.account.verifyphone.typecode') }}:</label>
						<div class="input-group">
							<input class="form-control" type="text" name="code" autocomplete="off">
						</div>
						@if($errors->has('code'))
							<p class="text-danger">{{ $errors->first('code') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="id" value="{{ $ticket->code }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> {{ __('user.account.verifyphone.button') }}</button>
				</div>
			</div>
		</form>
    </div>
</div>
@stop