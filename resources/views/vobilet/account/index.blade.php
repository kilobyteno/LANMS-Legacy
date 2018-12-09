@extends('layouts.main')
@section('title', 'Account')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Account</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">Account</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(Sentinel::getUser()->ownReservationsLastYear->count() > 0 && !Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> We can see that you attended last year. Want to join us for this year too? <a href="{{route('seating')}}">Check out the seating now</a>.
				</div>
			@endif
			@if(Sentinel::getUser()->age() < 16 && Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Vi kan se at du er under 16 år og på arrangementet må ha med samtykkeskjema ferdig utfyllt ved innskjekking. Ferdig generert skjema finner du her: <a href="{{ route('seating-consentform') }}"><i class="fa fa-user-circle-o"></i> Samtykkeskjema</a>
				</div>
			@endif
			@if(!Sentinel::getUser()->birthdate)
				<div class="alert alert-warning" role="alert">
					<i class="fa fa-exclamation-triangle"></i> There is no birthdate assigned to your account, this is required from now on. <a href="{{ route('user-profile-edit', Sentinel::getUser()->username) }}">Edit your profile</a>
				</div>
			@endif
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Account Details</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('user-profile-edit', Sentinel::getUser()->username) }}" class="text-inherit"><i class="fa fa-edit"></i> Edit Profile</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-change-images') }}" class="text-inherit"><i class="fas fa-images"></i> Change Profile Images</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-addressbook') }}" class="text-inherit"><i class="fa fa-book"></i> Manage Address Book</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-change-password') }}" class="text-inherit"><i class="fas fa-key"></i> Change Password</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Personal Data</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account-gdpr-download') }}" class="text-inherit"><i class="fas fa-download"></i> Download</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-gdpr-delete') }}" class="text-inherit"><i class="fas fa-trash"></i> Delete</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Reservations</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account-reservation') }}" class="text-inherit"><i class="fa fa-street-view"></i> Reservations <span class="badge badge-default">{{ \Sentinel::getUser()->reservations->count() }}</span></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Billing</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account-billing-payments') }}" class="text-inherit"><i class="fas fa-money-bill-alt"></i> Payments <span class="badge badge-default">{{ \Sentinel::getUser()->seatpayments->count() }}</span></a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-billing-charges') }}" class="text-inherit"><i class="fa fa-credit-card"></i> Charges</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					@if(Setting::get('REFERRAL_ACTIVE'))
						<div class="card">
							<div class="card-header">
								<h2 class="card-title">Referral</h2>
							</div>
							<div class="card-body">
								<p>This is the referral link you can share to your friends, this will track back to you if they register at this website.</p>
								<input class="form-control" type="text" value="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/r/{{ Sentinel::getUser()->referral_code }}">
								<br>
								<p>You have referred <strong>{{ User::where('referral', '=', Sentinel::getUser()->referral_code)->count() }}</strong> @if(User::where('referral', '=', Sentinel::getUser()->referral_code)->count() == 1){{ 'user.' }} @else {{ 'users.' }} @endif</p>
							</div>
						</div>
					@endif
					
				</div>
			</div>

		</div>
	</div>
</div>
@stop