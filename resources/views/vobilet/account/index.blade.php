@extends('layouts.main')
@section('title', trans('user.account.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('user.account.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(Sentinel::getUser()->ownReservationsLastYear->count() > 0 && !Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> {!! trans('user.alert.attendancelastyear', ['url' => route('seating')]) !!}
				</div>
			@endif
			@if(Sentinel::getUser()->age() < 16 && Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> {!! trans('user.alert.consentform', ['url' => route('seating-consentform')]) !!}
				</div>
			@endif
			@if(!Sentinel::getUser()->birthdate)
				<div class="alert alert-warning" role="alert">
					<i class="fa fa-exclamation-triangle"></i> {!! trans('user.alert.nobirthdate', ['url' => route('user-profile-edit', Sentinel::getUser()->username)]) !!}
				</div>
			@endif
			@if(!Sentinel::getUser()->phone)
				<div class="alert alert-warning" role="alert">
					<i class="fa fa-exclamation-triangle"></i> {!! trans('user.alert.nophone', ['url' => route('user-profile-edit', Sentinel::getUser()->username)]) !!}
				</div>
			@endif
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">{{ trans('user.account.details.title') }}</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('user-profile-edit', Sentinel::getUser()->username) }}" class="text-inherit"><i class="fa fa-edit"></i> {{ trans('user.account.details.editprofile') }}</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-change-images') }}" class="text-inherit"><i class="fas fa-images"></i> {{ trans('user.account.details.images') }}</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-addressbook') }}" class="text-inherit"><i class="fa fa-book"></i> {{ trans('user.account.details.addressbook') }}</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-change-password') }}" class="text-inherit"><i class="fas fa-key"></i> {{ trans('user.account.details.password') }}</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">{{ trans('user.account.personaldata.title') }}</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account-gdpr-download') }}" class="text-inherit"><i class="fas fa-download"></i> {{ trans('global.download') }}</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-gdpr-delete') }}" class="text-inherit"><i class="fas fa-trash"></i> {{ trans('global.delete') }}</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">{{ trans('user.account.reservations.title') }}</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account-reservation') }}" class="text-inherit"><i class="fa fa-street-view"></i> {{ trans('user.account.reservations.title') }} <span class="badge badge-default">{{ \Sentinel::getUser()->reservations->count() }}</span></a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-billing-payments') }}" class="text-inherit"><i class="fas fa-money-bill-alt"></i> {{ trans('user.account.billing.payments.title') }} <span class="badge badge-default">{{ \Sentinel::getUser()->seatpayments->count() }}</span></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">{{ trans('user.account.billing.title') }}</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account-billing-card') }}" class="text-inherit"><i class="fa fa-credit-card"></i> {{ trans('user.account.billing.card.title') }}</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-billing-invoice') }}" class="text-inherit"><i class="fas fa-file-invoice"></i> {{ trans('user.account.billing.invoice.title') }}</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-billing-charges') }}" class="text-inherit"><i class="fas fa-exchange-alt"></i> {{ trans('user.account.billing.charges.title') }}</a></td>
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
								<h2 class="card-title">{{ trans('user.account.referral.title') }}</h2>
							</div>
							<div class="card-body">
								<p>{{ trans('user.account.referral.desc') }}</p>
								<input class="form-control" type="text" value="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/r/{{ Sentinel::getUser()->referral_code }}">
								<br>
								<p>{!! trans_choice('user.account.referral.users', User::where('referral', Sentinel::getUser()->referral_code)->count()) !!}</p>
							</div>
						</div>
					@endif
					
				</div>
			</div>

		</div>
	</div>
</div>
@stop