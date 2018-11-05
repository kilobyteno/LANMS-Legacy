@extends('layouts.main')
@section('title', $currentseat->name.' - Seat')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Seat - {{ $currentseat->name }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">Seating</li>
			<li class="breadcrumb-item">Seat</li>
			<li class="breadcrumb-item active" aria-current="page">{{ $currentseat->name }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(Sentinel::getUser()->addresses->count() == 0)
				<div class="alert alert-warning" role="alert"> <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address. You should <a href="{{ route('account-addressbook-create') }}" class="alert-link">add</a> one.</div>
			@endif
			@if(!Setting::get('SEATING_OPEN'))
				<div class="alert alert-info" role="alert"><i class="fas fa-info mr-2" aria-hidden="true"></i> Seating is closed at this moment, you cannot reserve seats or change reservations.</div>
			@endif

			<div class="row">	
				<div class="col-md-6">

					@if(Setting::get('SEATING_SHOW_MAP'))
						@include('seating.seatmap')
					@else
						<h2>Seatmap is not available at this moment!</h2>
						<p>Please check back later...</p>
					@endif

				</div>
				<div class="col-md-6">
					@if($currentseat->reservationsThisYear()->first())
						<div class="alert alert-info" role="alert">
							<i class="fas fa-info mr-2" aria-hidden="true"></i> This seat is {{ strtolower($currentseat->reservationsThisYear()->first()->status->name) }} for this member.
						</div>
						<div class="card card-profile" style="background: url({{ $currentseat->reservationsThisYear()->first()->reservedfor->profilecover or '/images/profilecover/0.jpg' }}); background-size:cover;">
							<div class="card-body text-center">
								<a href="{{ route('user-profile', $currentseat->reservationsThisYear()->first()->reservedfor->username) }}">
									<img class="card-profile-img" src="{{ $currentseat->reservationsThisYear()->first()->reservedfor->profilepicture or '/images/profilepicture/0.png' }}">
									<h3 class="mb-3 text-white">{{ User::getFullnameAndNicknameByID($currentseat->reservationsThisYear()->first()->reservedfor->id) }}</h3>
								</a>
								@if(Sentinel::findById($currentseat->reservationsThisYear()->first()->reservedfor->id)->inRole('admin') || Sentinel::findById($currentseat->reservationsThisYear()->first()->reservedfor->id)->inRole('superadmin') || Sentinel::findById($currentseat->reservationsThisYear()->first()->reservedfor->id)->inRole('moderator'))
									<p class="mb-4 text-white">Staff</p>
								@else
									<p class="mb-4 text-white">Member</p>
								@endif
								<div class="row text-white">
									@if($currentseat->reservationsThisYear()->first()->reservedfor->occupation)
										<div class="col-sm-3">
											<i class="fa fa-briefcase"></i> {{ $currentseat->reservationsThisYear()->first()->reservedfor->occupation }}
										</div>
									@endif
									@if($currentseat->reservationsThisYear()->first()->reservedfor->location)
										<div class="col-sm-3">
											<i class="fa fa-map-marker"></i> {{ $currentseat->reservationsThisYear()->first()->reservedfor->location }}
										</div>
									@endif
									@if($currentseat->reservationsThisYear()->first()->reservedfor->gender)
										<div class="col-sm-3">
											<i class="fa fa-genderless"></i> {{ $currentseat->reservationsThisYear()->first()->reservedfor->gender }}
										</div>
									@endif
									@if($currentseat->reservationsThisYear()->first()->reservedfor->birthdate)
										<div class="col-sm-3">
											<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($currentseat->reservationsThisYear()->first()->reservedfor->birthdate), date_create('today'))->y }}
										</div>
									@endif
								</div>
							</div>
						</div>
					@elseif($currentseat->row_id == 1)
						<div class="alert alert-info" role="alert">
							<i class="fas fa-info mr-2" aria-hidden="true"></i>This seat cannot be reserved!
						</div>
					@elseif(Sentinel::getUser()->reservationsThisYear()->count() >= 5)
						<div class="alert alert-warning" role="alert">
							<i class="fas fa-exclamation mr-2" aria-hidden="true"></i> You are not allowed to reserve more than <em>five</em> seats.
						</div>
					@elseif(!Setting::get('SEATING_OPEN'))
						<div class="alert alert-info" role="alert"> <i class="fas fa-info mr-2" aria-hidden="true"></i> Seating is closed at this moment, you cannot reserve seats or change reservations.</div>
					@else
						<form method="post" action="{{ route('seating-reserve', $currentseat->slug) }}">
							<div class="form-group @if($errors->has('reservedfor')) has-error @endif">
								<label class="form-label">Reserved for</label>
								<input type="text" class="form-control" id="username" value="{{ User::getFullnameAndNicknameByID(Sentinel::getUser()->id) }}" autocomplete="off">
								<input type="text" id="reservedfor" name="reservedfor" value="{{ Sentinel::getUser()->id }}" hidden="">
								@if($errors->has('reservedfor'))
									<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
								@endif
							</div>
							<div class="form-group">
								<label class="custom-switch">
									<input type="checkbox" class="custom-switch-input" id="tos">
									<span class="custom-switch-indicator"></span>
									<span class="custom-switch-description">I have read and agree to the <strong>Terms of Service</strong> and the <strong>Rules</strong> of this event.</span>
								</label>
							</div>
							<div class="form-group">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" class="btn btn-success" id="reserve" disabled=""><i class="fas fa-hand-paper"></i> Reserve Seat</button>
							</div>
						</form>
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop
@section('javascript')
	<script src="{{ Theme::url('js/vendors/bootstrap-typeahead.min.js') }}"></script>
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
		var checker = document.getElementById('tos');
		var btn 	= document.getElementById('reserve');
		checker.onchange = function() {
			btn.disabled = !this.checked;
		};
	</script>
@stop