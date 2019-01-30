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
					<div class="row">
						<div class="col-sm-10 @if($errors->has('barcode')) has-error @endif">
							<input type="text" class="form-control input-lg" name="barcode" placeholder="Barcode (12345678910)" value="{{ (old('barcode')) ? old('barcode') : '' }}" autocomplete="off" autofocus />
							@if($errors->has('barcode'))
								<p class="text-danger">{{ $errors->first('barcode') }}</p>
							@endif
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-success btn-block btn-icon"><i class="fas fa-search mr-2"></i>Find Ticket</button>
						</div>
					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</div>
		</div>

		<br><hr><br>

		<div class="row">
			<div class="col-md-6">
				<h1 class="text-center">{{ Checkin::thisYear()->count() }}<small>/{{ $reservedcount }}</small><br><small>Atendees has checked-in</small></h1>
				<hr>
				@foreach($checkins as $checkin)
					<div class="col-md-4">
						{{ $checkin->ticket->reservation->seat->name }} &middot; {{ User::getFullnameAndNicknameByID($checkin->ticket->user->id) }}
					</div>
				@endforeach
			</div>
			<div class="col-md-6">
				<h1 class="text-center">{{ $noncheckedin->count() }}<br><small>Has not checked in yet</small></h1>
				<hr>
				<div class="row">
					@foreach($noncheckedin as $ticket)
						<div class="col-md-4">
							{{ $ticket->reservation->seat->name }} &middot; {{ User::getFullnameAndNicknameByID($ticket->user->id) }}
						</div>
					@endforeach
				</div>
			</div>
		</div>

	</div>
</div>

@stop