@extends('layouts.main')
@section('title', 'Atendee Check-in - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Atendee Check-in</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Atendee Check-in</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-seating-checkin-check') }}" method="post">
					<div class="input-group">
						<input type="text" class="form-control input-lg" name="barcode" placeholder="Barcode (12345678910)" value="{{ (old('barcode')) ? old('barcode') : '' }}" autocomplete="off" autofocus />
						<div class="input-group-append">
							<button type="submit" class="btn btn-success btn-block btn-icon"><i class="fas fa-search mr-2"></i>Find Ticket</button>
						</div>
					</div>
					@if($errors->has('barcode'))
						<p class="text-danger">{{ $errors->first('barcode') }}</p>
					@endif
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</div>
		</div>

		<br><hr><br>

		<div class="row">
			<div class="col-12 col-xl-4">
				@include('seating.seatmap')
			</div>
			<div class="col-12 col-xl-4">
				<h1 class="text-center">{{ $noncheckedin->count() }}<br><small>Has not checked in yet</small></h1>
				<hr>
				<div class="row">
					@foreach($noncheckedin as $ticket)
						<div class="col-lg-6">
							{{ $ticket->reservation->seat->name }} &middot; {{ User::getFullnameAndNicknameByID($ticket->user->id) }}  @if($ticket->reservation->payment) @if($ticket->reservation->payment->created_at < '2019-01-01 00:00:00')<span class="badge badge-warning"><i class="fas fa-stroopwafel"></i> {{ trans('seating.reservation.pizza.title') }}</span> @endif @endif
						</div>
					@endforeach
				</div>
			</div>
			<div class="col-12 col-xl-4">
				<h1 class="text-center">{{ Checkin::thisYear()->count() }}<small>/{{ $reservedcount }}</small><br><small>Atendees has checked-in</small></h1>
				<hr>
				<div class="row">
					@foreach($checkins as $checkin)
						<div class="col-lg-6">
							{{ $checkin->ticket->reservation->seat->name }} &middot; {{ User::getFullnameAndNicknameByID($checkin->ticket->user->id) }}  @if($checkin->ticket->reservation->payment) @if($checkin->ticket->reservation->payment->created_at < '2019-01-01 00:00:00')<span class="badge badge-warning"><i class="fas fa-stroopwafel"></i> {{ trans('seating.reservation.pizza.title') }}</span> @endif @endif
						</div>
					@endforeach
				</div>
			</div>
		</div>

	</div>
</div>

@stop