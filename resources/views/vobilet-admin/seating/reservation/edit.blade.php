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
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-seating-reservation-update', $reservation->id) }}" method="post">
					<div class="row">
						<div class="col-sm-1 input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">Seat</div>
							</div>
							<input type="text" class="form-control" id="seat" value="{{ $reservation->seat->name }}" autocomplete="off">
							<input type="hidden" id="seat_id" name="seat_id" value="{{ $reservation->seat->id }}">
							@if($errors->has('seat_id'))
								<p class="text-danger">{{ $errors->first('seat_id') }}</p>
							@endif
						</div>

						<div class="col-sm-4 input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">Reserved by</div>
							</div>
							<input type="text" class="form-control" id="seat" value="{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}" readonly="" disabled="">
						</div>
						
						<div class="col-sm-4 input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">Reserved for</div>
							</div>
							<input type="text" class="form-control" id="reservedfor" value="{{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}" autocomplete="off">
							<input type="hidden" id="reservedfor_id" name="reservedfor_id" value="{{ $reservation->reservedfor->id }}">
							@if($errors->has('reservedfor'))
								<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
							@endif
						</div>

						<div class="col-sm-3">
							@if(!$reservation->ticket && $reservation->status_id != 1)
								<a class="btn btn-orange btn-lg btn-block" href="{{ route('admin-seating-reservation-paylater', $reservation->seat->slug) }}"><i class="fas fa-door-open mr-2"></i>Mark as 'Pay at entrance'</a>
							@endif
							<button type="submit" class="btn btn-success btn-block"><i class="fas fa-save mr-2"></i>Save</button>
						</div>
						
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>
	</div>
</div>

@stop

@section('javascript')
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$('#seat').typeahead({
					onSelect: function(item) {
						document.getElementById("seat_id").value = item.value;
						console.log("seat_id: " + item.value);
					},
					ajax: {
						url: "/ajax/seats",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
				$('#reservedfor').typeahead({
					onSelect: function(item) {
						document.getElementById("reservedfor_id").value = item.value;
						console.log("reservedfor_id: " + item.value);
					},
					ajax: {
						url: "/ajax/usernames",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop