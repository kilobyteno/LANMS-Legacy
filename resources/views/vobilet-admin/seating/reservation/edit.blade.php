@extends('layouts.main')
@section('title', 'Edit Reservation: #'.$reservation->id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Reservation: #{{ $reservation->id }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-reservations') }}">Reservations</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Reservation: #{{ $reservation->id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-12 col-xl-8">

		<form class="card" action="{{ route('admin-seating-reservation-update', $reservation->id) }}" method="post">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-2">
						<div class="form-group">
							<label class="form-label">Seat:</label>
							<select name="seat_id" class="select2">
								<option value="{{ $reservation->seat->id }}" selected="">{{ $reservation->seat->name }}</option>
								@foreach(\Seats::doesntHave('reservationsThisYear')->get() as $seat)
									<option value="{{ $seat->id }}">{{ $seat->name }}</option>
								@endforeach
							</select>
						</div>
						@if($errors->has('seat_id'))
							<p class="text-danger">{{ $errors->first('seat_id') }}</p>
						@endif
					</div>

					<div class="col-sm-5">
						<div class="form-group">
							<label class="form-label">Reserved by:</label>
							<input type="text" class="form-control input-lg disabled" disabled="" value="{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}" />
						</div>
					</div>
					
					<div class="col-sm-5">
						<div class="form-group">
							<label class="form-label">Reserved for:</label>
							<select name="reservedfor" class="select2">
								@foreach(\User::orderBy('lastname', 'asc')->whereNotNull('last_activity')->where('isAnonymized', '0')->get() as $user)
									<option value="{{ $user->id }}" @if($reservation->reservedfor->id == $user->id) selected="" @endif>{{ User::getFullnameAndNicknameByID($user->id) }}</option>
								@endforeach
							</select>
						</div>
						@if($errors->has('reservedfor'))
							<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
						@endif
					</div>
					
				</div>
			</div>
			<div class="card-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				@if(!$reservation->ticket && $reservation->status_id != 1)
					<a class="btn btn-orange" href="{{ route('admin-seating-reservation-paylater', $reservation->seat->slug) }}"><i class="fas fa-door-open mr-2"></i>Mark as 'Pay at entrance'</a>
				@endif
				<button type="submit" class="btn btn-success float-right"><i class="fas fa-save mr-2"></i>Save</button>
			</div>
		</form>
	</div>
</div>

@stop
@section('javascript')
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
@stop