@extends('layouts.main')
@section('title', trans('seating.ticket.title'))
@section('content')

<div class="container">
    <div class="page-header d-print-none">
        <h4 class="page-title">{{ trans('seating.ticket.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('seating') }}">{{ trans('header.seating') }}</a></li>
			<li class="breadcrumb-item">{{ trans('seating.show.seat') }}</li>
			<li class="breadcrumb-item">{{ $reservation->seat->name }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('seating.ticket.title') }}</li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
        	<div class="card">
				<div class="card-body">
					<div class="text-center">
						<img src="{{ Setting::get('WEB_LOGO_DARK') }}" style="max-width:50%;display: inline-block;">
						<h1 class="my-5">{{ trans('seating.ticket.title') }}</h1>
					</div>
					<hr>
					<h2 class="text-center">{{ $reservation->reservedfor->firstname.' '.$reservation->reservedfor->lastname }}<br><small>{{ $reservation->reservedfor->username }}</small></h2>
					<br>
					<p>{{ trans('pdf.ticket.desc') }}</p>
					<hr>
					<div class="row text-center mt-5">
						<div class="col-12 col-lg-4">
							<h2><strong><small>{{ trans('global.type') }}:</small><br>{{ $reservation->seat->tickettype->name }}</strong></h2>
						</div>
						<div class="col-12 col-lg-4">
							@if(!$reservation->payment)
								<h2><strong><small>{{ trans('global.payment.paid') }}:</small><br><span class="text-danger">{{ trans('global.no') }}<br>{{ moneyFormat($reservation->seat->tickettype->price, Setting::get('MAIN_CURRENCY')) }}</span></strong></h2>
							@else
								<h2><strong><small>{{ trans('global.payment.paid') }}:</small><br><span class="text-success">{{ trans('global.yes') }}</span></strong></h2>
							@endif
						</div>
						<div class="col-12 col-lg-4">
							<h2><strong><small>{{ trans('pdf.ticket.yourseat') }}:</small><br>{{ $reservation->seat->name }}</strong></h2>
						</div>
					</div>
					@if($reservation->payment && $reservation->reservedfor->age() >= 15)
						<hr>
						<div class="row text-center mt-5">
							<div class="col-12">
								<p>{{ trans('seating.ticket.checkin.title') }}: <strong>{{ $reservation->ticket->code ?? trans('global.unknown') }}</strong></p>
							</div>
						</div>
					@endif
					<hr>
					<div class="mt-5">
						<img style="display: inline-block;" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($reservation->ticket->barcode, "I25", 4, 40) }}" />
						<h4 class="mt-2">{{ $reservation->ticket->barcode }}</h4>
					</div>
				</div>
				<div class="card-footer d-print-none">
					<button type="button" class="btn btn-secondary" onclick="javascript:window.print();"><i class="fas fa-print"></i> {{ trans('global.print') }}</button>
				</div>
			</div>
        </div>
    </div>
</div>
@stop