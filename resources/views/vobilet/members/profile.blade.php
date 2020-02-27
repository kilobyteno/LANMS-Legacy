@extends('layouts.main')
@section('title', $username . ' - '.trans('user.profile.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('user.profile.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('user.profile.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-profile " style="background: url({{ $profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<img class="card-profile-img" src="{{ $profilepicture ?? '/images/profilepicture/0.png' }}">
					<h3 class="mb-3 text-white">{{ $firstname }}@if($showname) {{ $lastname }}@endif</h3>
					@if(Sentinel::findById($id)->inRole('admin') || Sentinel::findById($id)->inRole('superadmin') || Sentinel::findById($id)->inRole('moderator'))
						<p class="mb-4 text-white">{{ trans('global.staff') }}</p>
					@else
						<p class="mb-4 text-white">{{ trans('global.member') }}</p>
					@endif
					@if(\Sentinel::getUser()->id == $id)
						<a href="{{ route('user-profile-edit', $username) }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i> {{ trans('user.profile.editprofile') }}</a>
						<a href="{{ route('account-change-images') }}" class="btn btn-secondary btn-sm"><i class="fas fa-images"></i> {{ trans('user.profile.editimages') }}</a>
					@endif
				</div>
			</div>
		</div>
		@if($isAnonymized)
			<div class="col-lg-12">
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-frown mr-2" aria-hidden="true"></i> {{ trans('user.profile.alert.userdeleted') }}
				</div>
			</div>
		@else
			<div class="col-lg-5">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">{{ trans('global.verification') }}</h3>
					</div>
					<div class="card-body">
						<p class="@if(Activation::completed(Sentinel::findById($id))){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-envelope"></i> {{ trans('global.email') }} @if(Activation::completed(Sentinel::findById($id))){{ trans('global.verified') }}@else{{ trans('global.notverified') }}@endif</p>
						<p class="@if($phone_verified_at){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-phone"></i> {{ trans('global.phone') }} @if($phone_verified_at){{ trans('global.verified') }}@else{{ trans('global.notverified') }}@endif</p>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">{{ trans('user.profile.attendance') }}</h3>
					</div>
					@if(Sentinel::findById($id)->ownReservationsThisYear->count()>0 || Sentinel::findById($id)->ownReservationsLastYear->count()>0)
						<div class="table-responsive">
							<table class="table card-table table-vcenter text-nowrap">
								<tbody>
									@if(Sentinel::findById($id)->ownReservationsThisYear->count()>0)
										@foreach(Sentinel::findById($id)->ownReservationsThisYearDecending as $reservation)
											<tr>
												<td class="no-border">{{ trans('user.profile.reservedaseatfor') }} {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</td>
												<td class="no-border text-right"><span class="tag tag-rounded">{{ date('M Y', strtotime($reservation->created_at)) }}</span></td>
											</tr>
										@endforeach
									@endif
									@if(Sentinel::findById($id)->ownReservationsLastYear->count()>0)
										@foreach(Sentinel::findById($id)->ownReservationsLastYearDecending as $reservation)
											<tr>
												<td class="no-border">{{ trans('user.profile.reservedaseatfor') }} {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</td>
												<td class="no-border text-right"><span class="tag tag-rounded">{{ date('M Y', strtotime($reservation->created_at)) }}</span></td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					@else
						<div class="card-body"><p class="text-muted"><em>{{ trans('user.profile.noattendance') }}</em></p></div>
					@endif
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
												<td><strong>{{ trans('global.username') }}:</strong> {{ $username }}</td>
											</tr>
											<tr>
												<td><strong>{{ trans('global.joined') }}:</strong> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $created_at }}">{{ \Carbon::parse($created_at)->diffForHumans() }}</span></td>
											</tr>
											@if($location)
												<tr>
													<td><strong>{{ trans('global.location') }}:</strong> {{ $location }}</td>
												</tr>
											@endif
											@if($gender)
												<tr>
													<td><strong>{{ trans('global.gender.title') }}:</strong> <i class="fa fa-{{ User::getGenderIcon($gender) }}"></i> {{ trans('global.gender.'.strtolower($gender)) }}</td>
												</tr>
											@endif
										</tbody>
										<tbody class="col-lg-6 p-0">
											@if($showemail)
												<tr>
													<td><strong>{{ trans('global.email') }}:</strong> {{ $email }}</td>
												</tr>
											@endif
											@if($showonline && $last_activity && $last_activity != '0000-00-00 00:00:00')
												<tr>
													<td><strong>{{ trans('global.lastseen') }}:</strong> {{ \Carbon::parse($last_activity)->diffForHumans() }}</td>
												</tr>
											@endif
											@if($occupation)
												<tr>
													<td><strong>{{ trans('global.occupation') }}:</strong> {{ $occupation }}</td>
												</tr>
											@endif
											@if($birthdate)
												<tr>
													<td><strong>{{ trans('global.age') }}:</strong> {{ \Carbon::parse($birthdate)->age }} {{ trans('global.yearsold') }}</td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
								@if($about)
									<div class="row mt-5">
										<div class="col-md-12">
											<div class="media-heading">
												<h5><strong>{{ trans('global.about') }}</strong></h5>
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