@extends('layouts.main')
@section('title', 'Reservation #'.$reservation->id)
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Reservations</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">User</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">Account</a></li>
			<li class="breadcrumb-item">Reservations</li>
			<li class="breadcrumb-item active" aria-current="page">Reservation #{{ $reservation->id }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h3>Reserved by</h3>
			<div class="card card-profile" style="background: url({{ $reservation->reservedby->profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<a href="{{ route('user-profile', $reservation->reservedby->username) }}">
						<img class="card-profile-img" src="{{ $reservation->reservedby->profilepicture ?? '/images/profilepicture/0.png' }}">
						<h3 class="mb-3 text-white">{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}</h3>
					</a>
					@if(Sentinel::findById($reservation->reservedby->id)->inRole('admin') || Sentinel::findById($reservation->reservedby->id)->inRole('superadmin') || Sentinel::findById($reservation->reservedby->id)->inRole('moderator'))
						<p class="mb-4 text-white">Staff</p>
					@else
						<p class="mb-4 text-white">Member</p>
					@endif
					<div class="row text-white">
						@if($reservation->reservedby->occupation)
							<div class="col-sm-6">
								<i class="fa fa-briefcase"></i> {{ $reservation->reservedby->occupation }}
							</div>
						@endif
						@if($reservation->reservedby->location)
							<div class="col-sm-6">
								<i class="fa fa-map-marker"></i> {{ $reservation->reservedby->location }}
							</div>
						@endif
						@if($reservation->reservedby->gender)
							<div class="col-sm-6">
								<i class="fa fa-genderless"></i> {{ $reservation->reservedby->gender }}
							</div>
						@endif
						@if($reservation->reservedby->birthdate)
							<div class="col-sm-6">
								<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($reservation->reservedby->birthdate), date_create('today'))->y }}
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<h3>Reserved for</h3>
			<div class="card card-profile" style="background: url({{ $reservation->reservedfor->profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<a href="{{ route('user-profile', $reservation->reservedfor->username) }}">
						<img class="card-profile-img" src="{{ $reservation->reservedfor->profilepicture ?? '/images/profilepicture/0.png' }}">
						<h3 class="mb-3 text-white">{{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</h3>
					</a>
					@if(Sentinel::findById($reservation->reservedfor->id)->inRole('admin') || Sentinel::findById($reservation->reservedfor->id)->inRole('superadmin') || Sentinel::findById($reservation->reservedfor->id)->inRole('moderator'))
						<p class="mb-4 text-white">Staff</p>
					@else
						<p class="mb-4 text-white">Member</p>
					@endif
					<div class="row text-white">
						@if($reservation->reservedfor->occupation)
							<div class="col-sm-6">
								<i class="fa fa-briefcase"></i> {{ $reservation->reservedfor->occupation }}
							</div>
						@endif
						@if($reservation->reservedfor->location)
							<div class="col-sm-6">
								<i class="fa fa-map-marker"></i> {{ $reservation->reservedfor->location }}
							</div>
						@endif
						@if($reservation->reservedfor->gender)
							<div class="col-sm-6">
								<i class="fa fa-genderless"></i> {{ $reservation->reservedfor->gender }}
							</div>
						@endif
						@if($reservation->reservedfor->birthdate)
							<div class="col-sm-6">
								<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($reservation->reservedfor->birthdate), date_create('today'))->y }}
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<h3>Info</h3>
			<p><strong>Year:</strong> {{ $reservation->year }}</p>
			<p><strong>Seat:</strong> {{ $reservation->seat->name }}</p>
			<h3>Actions</h3>
			@if($reservation->payment_id)<p><a href="{{ route('account-billing-payment', $reservation->payment_id) }}" class="btn btn-success btn-sm"><i class="fas fa-money-bill-alt"></i> View Payment</a></p>@endif
			<p><a href="{{ route('seating-ticket-download', $reservation->seat->slug) }}" class="btn btn-info btn-sm"><i class="fas fa-ticket-alt"></i> Download Ticket</a></p>
			@if($reservation->payment_id)<p><a href="{{ route('account-billing-receipt', $reservation->payment_id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-print"></i> Download Receipt</a></p>@endif
			@if(Sentinel::getUser()->age() < 16)
				<p><a href="{{ route('seating-consentform') }}" class="btn btn-dark btn-sm popover-primary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Du er under 16 år og må ha med samtykkeskjema, ferdig utfyllt ved innskjekking på arrangementet." data-original-title="Hvorfor ser jeg denne?"><i class="fas fa-user-tie"></i> Samtykkeskjema</a></p>
			@endif
		</div>
	</div>
</div>
@stop