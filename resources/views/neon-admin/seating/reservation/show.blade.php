@extends('layouts.main')
@section('title', 'Seat - '.$currentseat->name.' - Admin')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')
<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Reservations</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li><a href="{{ route('admin-seating-reservations') }}">Reservations</a></li>
			<li class="active"><strong>Show Seat</strong></li>
		</ol>

		<br />
		<div class="row">
			<div class="col-md-4">
				@include('seating.seatmap')
			</div>
			<div class="col-md-8">
				@if($currentseat->reservationsThisYear()->first())
					<div class="alert alert-info" role="alert">
						<strong>Information:</strong> This seat is {{ strtolower($currentseat->reservationsThisYear()->first()->status->name) }}.
					</div>
					<div class="member-entry">
						<a href="{{ route('user-profile', $currentseat->reservationsThisYear()->first()->reservedfor->username) }}" class="member-img">
							<img src="{{ $currentseat->reservationsThisYear()->first()->reservedfor->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
							<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
						</a>
						<div class="member-details">
							<h4>
								<a href="{{ route('user-profile', $currentseat->reservationsThisYear()->first()->reservedfor->username) }}">{{ $currentseat->reservationsThisYear()->first()->reservedfor->firstname }}@if($currentseat->reservationsThisYear()->first()->reservedfor->showname) {{ $currentseat->reservationsThisYear()->first()->reservedfor->lastname }}@endif</a>
							</h4>
							<div class="row info-list">
								@if($currentseat->reservationsThisYear()->first()->reservedfor->occupation)
									<div class="col-sm-6">
										<i class="fa fa-briefcase"></i> {{ $currentseat->reservationsThisYear()->first()->reservedfor->occupation }}
									</div>
								@endif
								@if($currentseat->reservationsThisYear()->first()->reservedfor->location)
									<div class="col-sm-6">
										<i class="fa fa-map-marker"></i> {{ $currentseat->reservationsThisYear()->first()->reservedfor->location or '<em>Unkown</em>' }}
									</div>
								@endif
								<div class="clear"></div>
								@if($currentseat->reservationsThisYear()->first()->reservedfor->gender)
									<div class="col-sm-6">
										<i class="fa fa-genderless"></i> {{ $currentseat->reservationsThisYear()->first()->reservedfor->gender }}
									</div>
								@endif
								@if($currentseat->reservationsThisYear()->first()->reservedfor->birthdate)
									<div class="col-sm-6">
										<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($currentseat->reservationsThisYear()->first()->reservedfor->birthdate), date_create('today'))->y }}
									</div>
								@endif
							</div>
						</div>
					</div>
				@elseif($currentseat->row_id == 1)
					<div class="alert alert-info" role="alert">
						<strong>Information:</strong> This seat cannot be reserved!
					</div>
				@elseif(Sentinel::getUser()->reservationsThisYear()->count() >= 5)
					<div class="alert alert-warning" role="alert">
						<strong>Warning!</strong> You are not allowed to reserve more than <em>five</em> seats.
					</div>
				@elseif(!Setting::get('SEATING_OPEN'))
					<div class="alert alert-info" role="alert"> <strong>INFO!</strong> Seating is closed at this moment, you cannot reserve seats or change reservations.</div>
				@else
					<form class="form-horizontal" method="post" action="{{ route('seating-reserve', $currentseat->slug) }}">
						<div class="form-group">
							<label class="col-sm-2 control-label">
								Reserved for
							</label>
							<div class="col-sm-10 @if($errors->has('reservedfor')) has-error @endif">
								<input type="text" class="form-control" id="username" value="{{ Sentinel::getUser()->username.' ('.Sentinel::getUser()->firstname.')' }}" autocomplete="off">
								<input type="text" class="hidden" id="reservedfor" name="reservedfor" value="{{ Sentinel::getUser()->id }}">
								@if($errors->has('reservedfor'))
									<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
								@endif
								<div class="checkbox">
									<label><input type="checkbox" id="tos"> I have read, accepted and agreed to the <a href="{{ url('tos') }}" target="_blank">Terms of Service</a>.</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" class="btn btn-success" id="reserve" disabled=""><i class="fa fa-hand-paper-o"></i> Reserve Seat</button>
							</div>
						</div>
					</form>
				@endif
			</div>
		</div>

	</div>
</div>
@stop

@section('javascript')
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#username').typeahead({
					onSelect: function(item) {
						document.getElementById("reservedfor").value = item.value;
						console.log(item.value);
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