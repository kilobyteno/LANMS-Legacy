@extends('layouts.main')
@section('title', $username . ' - '.trans('user.profile.title'))
@section('content')

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-12 col-lg-6 col-xl-6">
			<p class="text-muted text-center">{{ Carbon::now() }} &middot; {{ $uuid }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card card-profile " style="background: url({{ $profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
						<div class="card-body text-center">
							<img class="card-profile-img" src="{{ $profilepicture ?? '/images/profilepicture/0.png' }}">
						</div>
					</div>
					<div class="card">
						<div class="card-body text-center">
							<p class="@if(Activation::completed(Sentinel::findById($id))){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-envelope"></i> {{ trans('global.email') }} @if(Activation::completed(Sentinel::findById($id))){{ trans('global.verified') }}@else{{ trans('global.notverified') }}@endif</p>
							<p class="@if($phone_verified_at){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-phone"></i> {{ trans('global.phone') }} @if($phone_verified_at){{ trans('global.verified') }}@else{{ trans('global.notverified') }}@endif</p>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div id="profile-log-switch">
								<div class="fade show active">
									<div class="table-responsive border">
										<table class="table row table-borderless w-100 m-0">
											<tbody class="col-12 col-lg-6 col-xl-6 p-0">
												<tr>
													<td><strong>{{ trans('global.fullname') }}:</strong> {{ $firstname }} {{ $lastname }}</td>
												</tr>
												@if($birthdate)
													<tr>
														<td><strong>{{ trans('global.age') }}:</strong> {{ \Carbon::parse($birthdate)->age }} {{ trans('global.yearsold') }} ({{ \Carbon::parse($birthdate)->format('Y-m-d') }})</td>
													</tr>
												@else
													<tr>
														<td class="text-danger"><strong>{{ trans('global.unknown') }} {{ trans('global.age') }}!</strong></td>
													</tr>
												@endif
												<tr>
													<td><strong>{{ trans('global.email') }}:</strong> {{ $email }}</td>
												</tr>
												<tr>
													<td><strong>{{ trans('global.phone') }}:</strong> {{ $phone }}</td>
												</tr>
											</tbody>
											<tbody class="col-12 col-lg-6 col-xl-6 p-0">
												<tr>
													<td><strong>{{ trans('global.username') }}:</strong> {{ $username }}</td>
												</tr>
												<tr>
													<td><strong>{{ trans('global.joined') }}:</strong> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $created_at }}">{{ \Carbon::parse($created_at)->diffForHumans() }}</span></td>
												</tr>
												@if($gender)
													<tr>
														<td><strong>{{ trans('global.gender.title') }}:</strong> <i class="fa fa-{{ User::getGenderIcon($gender) }}"></i> {{ trans('global.gender.'.strtolower($gender)) }}</td>
													</tr>
												@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							@if(Sentinel::findById($id)->ownReservationsThisYear->count() > 0)
								@foreach(Sentinel::findById($id)->ownReservationsThisYearDecending as $reservation)
									<div class="list d-flex align-items-center border-bottom pb-3">
										<div class="avatar brround d-block" style="background-image: url({{ $profilepicture ?? '/images/profilepicture/0.png' }})">
											{{--<span class="avatar-status bg-green"></span>--}}
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0">{!! trans('user.profile.activity.reservedaseatfor', ['name' => $firstname]) !!} {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</p>
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
			</div>
			<p class="text-muted text-center">{{ Carbon::now() }} &middot; {{ $uuid }}</p>
		</div>
	</div>
</div>
@stop