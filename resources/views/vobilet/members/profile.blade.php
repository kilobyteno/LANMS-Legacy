@extends('layouts.main')
@section('title', $username . ' - '.__('user.profile.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('user.profile.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('user.profile.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-profile " style="background: url({{ $profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<img class="card-profile-img" src="{{ $profilepicture ?? '/images/profilepicture/0.png' }}">
					<h3 class="mb-3 text-white">{{ $firstname }}@if($showname) {{ $lastname }}@endif</h3>
					@if(Sentinel::findById($id)->inRole('admin') || Sentinel::findById($id)->inRole('superadmin') || Sentinel::findById($id)->inRole('moderator'))
						<p class="mb-4 text-white">{{ __('global.staff') }}</p>
					@else
						<p class="mb-4 text-white">{{ __('global.member') }}</p>
					@endif
					@if(\Sentinel::getUser()->id == $id)
						<a href="{{ route('user-profile-edit', $username) }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i> {{ __('user.profile.editprofile') }}</a>
						<a href="{{ route('account-change-images') }}" class="btn btn-secondary btn-sm"><i class="fas fa-images"></i> {{ __('user.profile.editimages') }}</a>
					@endif
				</div>
			</div>
		</div>
		@if($isAnonymized)
			<div class="col-lg-12">
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-frown mr-2" aria-hidden="true"></i> {{ __('user.profile.alert.userdeleted') }}
				</div>
			</div>
		@else
			<div class="col-lg-5">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">{{ __('global.verification') }}</h3>
					</div>
					<div class="card-body">
						<p class="@if(Activation::completed(Sentinel::findById($id))){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-envelope"></i> {{ __('global.email') }} @if(Activation::completed(Sentinel::findById($id))){{ __('global.verified') }}@else{{ __('global.notverified') }}@endif</p>
						<p class="@if($phone_verified_at){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-phone"></i> {{ __('global.phone') }} @if($phone_verified_at){{ __('global.verified') }}@else{{ __('global.notverified') }}@endif</p>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between mb-5">
							<h4 class="card-title">{{ __('user.profile.activity.title') }}</h4>
						</div>
						@if(Sentinel::findById($id)->ownReservationsThisYear->count() > 0)
							@foreach(Sentinel::findById($id)->ownReservationsThisYearDecending as $reservation)
								<div class="list d-flex align-items-center border-bottom py-3">
									<div class="avatar brround d-block" style="background-image: url({{ $profilepicture ?? '/images/profilepicture/0.png' }})">
										{{--<span class="avatar-status bg-green"></span>--}}
									</div>
									<div class="wrapper w-100 ml-3">
										<p class="mb-0">{!! __('user.profile.activity.reservedaseatfor', ['name' => $firstname]) !!} {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</p>
										<div class="d-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted mr-1"></i>
												<p class="mb-0">{{ \Carbon::parse($reservation->created_at)->isoFormat('LL') }}</p>
											</div>
											<small class="text-muted ml-auto">{{ \Carbon::parse($reservation->created_at)->diffForHumans() }}</small>
										</div>
									</div>
								</div>
							@endforeach
						@endif
						@if(Sentinel::findById($id)->ownReservationsLastYear->count() > 0)
							@foreach(Sentinel::findById($id)->ownReservationsLastYearDecending as $reservation)
								<div class="list d-flex align-items-center border-bottom py-3">
									<div class="avatar brround d-block" style="background-image: url({{ $profilepicture ?? '/images/profilepicture/0.png' }})">
										{{--<span class="avatar-status bg-green"></span>--}}
									</div>
									<div class="wrapper w-100 ml-3">
										<p class="mb-0">{!! __('user.profile.activity.reservedaseatfor', ['name' => $firstname]) !!} {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</p>
										<div class="d-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted mr-1"></i>
												<p class="mb-0">{{ \Carbon::parse($reservation->created_at)->isoFormat('LL') }}</p>
											</div>
											<small class="text-muted ml-auto">{{ \Carbon::parse($reservation->created_at)->diffForHumans() }}</small>
										</div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>

			</div>
			<div class="col-lg-7">
				<div class="card">
					<div class="card-body">
						<div id="profile-log-switch">
							<div class="fade show active">
								<div class="table-responsive border">
									<table class="table row table-borderless w-100 m-0">
										<tbody class="col-lg-6 p-0">
											<tr>
												<td><strong>{{ __('global.username') }}:</strong> {{ $username }}</td>
											</tr>
											<tr>
												<td><strong>{{ __('global.joined') }}:</strong> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $created_at }}">{{ \Carbon::parse($created_at)->diffForHumans() }}</span></td>
											</tr>
											@if($location)
												<tr>
													<td><strong>{{ __('global.location') }}:</strong> {{ $location }}</td>
												</tr>
											@endif
											@if($gender)
												<tr>
													<td><strong>{{ __('global.gender.title') }}:</strong> <i class="fa fa-{{ User::getGenderIcon($gender) }}"></i> {{ __('global.gender.'.strtolower($gender)) }}</td>
												</tr>
											@endif
										</tbody>
										<tbody class="col-lg-6 p-0">
											@if($showemail)
												<tr>
													<td><strong>{{ __('global.email') }}:</strong> {{ $email }}</td>
												</tr>
											@endif
											@if($showonline && $last_activity && $last_activity != '0000-00-00 00:00:00')
												<tr>
													<td><strong>{{ __('global.lastseen') }}:</strong> {{ \Carbon::parse($last_activity)->diffForHumans() }}</td>
												</tr>
											@endif
											@if($occupation)
												<tr>
													<td><strong>{{ __('global.occupation') }}:</strong> {{ $occupation }}</td>
												</tr>
											@endif
											@if($birthdate)
												<tr>
													<td><strong>{{ __('global.age') }}:</strong> {{ \Carbon::parse($birthdate)->age }} {{ __('global.yearsold') }}</td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
								@if($about)
									<div class="row mt-5">
										<div class="col-md-12">
											<div class="media-heading">
												<h5><strong>{{ __('global.about') }}</strong></h5>
											</div>
											<p>{{ $about }}</p>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>
@stop