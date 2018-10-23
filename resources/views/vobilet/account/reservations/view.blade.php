@extends('layouts.main')
@section('title', 'Reservation #'.$reservation->id)
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Reservations</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item">Account</li>
			<li class="breadcrumb-item">Reservations</li>
			<li class="breadcrumb-item active" aria-current="page">Reservation #{{ $reservation->id }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h3>Reserved by</h3>
			<div class="member-entry">
				<a href="{{ route('user-profile', $reservation->reservedby->username) }}" class="member-img">
					<img src="{{ $reservation->reservedby->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
					<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
				</a>
				<div class="member-details">
					<h4>
						<a href="{{ route('user-profile', $reservation->reservedby->username) }}">{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}</a>
					</h4>
					<div class="row info-list">
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
						<div class="clear"></div>
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
			<div class="member-entry">
				<a href="{{ route('user-profile', $reservation->reservedfor->username) }}" class="member-img">
					<img src="{{ $reservation->reservedfor->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
					<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
				</a>
				<div class="member-details">
					<h4>
						<a href="{{ route('user-profile', $reservation->reservedfor->username) }}">{{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a>
					</h4>
					<div class="row info-list">
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
						<div class="clear"></div>
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
			<p><a href="{{ route('account-billing-payment', $reservation->payment_id) }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-money"></i> View Payment</a></p>
			<p><a href="{{ route('seating-ticket-download', $reservation->seat->slug) }}" class="btn btn-info btn-icon icon-left"><i class="fa fa-ticket"></i> Download Ticket</a></p>
			<p><a href="{{ route('account-billing-receipt', $reservation->payment_id) }}" class="btn btn-default btn-icon icon-left"><i class="fa fa-print"></i> Download Receipt</a></p>
			@if(Sentinel::getUser()->age() < 16)
				<p><a href="{{ route('seating-consentform') }}" class="btn btn-primary popover-primary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Du er under 16 år og må ha med samtykkeskjema ferdig utfyllt ved innskjekking på arrangementet." data-original-title="Hvorfor ser jeg denne?"><i class="fa fa-user-circle-o"></i> Samtykkeskjema</a></p>
			@endif
		</div>
	</div>
</div>
@stop