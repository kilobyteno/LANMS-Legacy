@extends('layouts.main')
@section('title', 'Reserve Seat: '.$seat->name.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Reserve Seat</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Reserve Seat: {{ $seat->name }}</li>
	</ol>
</div>



<div class="row">
	<div class="col-12 col-xl-4">
		@include('seating.seatmap')
	</div>
	<div class="col-12 col-xl-8">
		@if(!$seat->reservationThisYear()->first())
			<form class="card" method="post" action="{{ route('admin-seating-reservation-reserve', $seat->slug) }}">
				<div class="card-body">
					<div class="form-group">
						<label class="form-label">Reserved for:</label>
						<select name="reservedfor" class="select2">
							@foreach(\User::orderBy('lastname', 'asc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->get() as $user)
								<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
						@if($errors->has('reservedfor'))
							<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-success" type="submit"><i class="fas fa-hand-paper mr-2"></i>Reserve Seat</button>
				</div>
			</form>
		@else
			<div class="card card-profile" style="background: url({{ $seat->reservationsThisYear()->first()->reservedfor->profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<a href="{{ route('user-profile', $seat->reservationsThisYear()->first()->reservedfor->username) }}">
						<img class="card-profile-img" src="{{ $seat->reservationsThisYear()->first()->reservedfor->profilepicture ?? '/images/profilepicture/0.png' }}">
						<h3 class="mb-3 text-white">{{ User::getFullnameAndNicknameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}</h3>
					</a>
					@if(Sentinel::findById($seat->reservationsThisYear()->first()->reservedfor->id)->inRole('admin') || Sentinel::findById($seat->reservationsThisYear()->first()->reservedfor->id)->inRole('superadmin') || Sentinel::findById($seat->reservationsThisYear()->first()->reservedfor->id)->inRole('moderator'))
						<p class="mb-4 text-white">{{ trans('global.staff') }}</p>
					@else
						<p class="mb-4 text-white">{{ trans('global.member') }}</p>
					@endif
					<div class="row text-white">
						@if($seat->reservationsThisYear()->first()->reservedfor->occupation)
							<div class="col-sm-3">
								<i class="fa fa-briefcase"></i> {{ $seat->reservationsThisYear()->first()->reservedfor->occupation }}
							</div>
						@endif
						@if($seat->reservationsThisYear()->first()->reservedfor->location)
							<div class="col-sm-3">
								<i class="fa fa-map-marker"></i> {{ $seat->reservationsThisYear()->first()->reservedfor->location }}
							</div>
						@endif
						@if($seat->reservationsThisYear()->first()->reservedfor->gender)
							<div class="col-sm-3">
								<i class="fa fa-genderless"></i> {{ $seat->reservationsThisYear()->first()->reservedfor->gender }}
							</div>
						@endif
						@if($seat->reservationsThisYear()->first()->reservedfor->birthdate)
							<div class="col-sm-3">
								<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($seat->reservationsThisYear()->first()->reservedfor->birthdate), date_create('today'))->y }}
							</div>
						@endif
					</div>
				</div>
			</div>
		@endif
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