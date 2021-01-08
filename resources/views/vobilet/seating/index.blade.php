@extends('layouts.main')
@section('title', __('header.seating'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('header.seating') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('header.seating') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(!Sentinel::getUser()->hasAddress())
				<div class="alert alert-warning" role="alert"> <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> {!! __('seating.alert.noaddress', ['url' => route('user-profile-edit', Sentinel::getUser()->username)]) !!}</div>
			@endif
			@if(!Setting::get('SEATING_OPEN'))
				<div class="alert alert-info" role="alert"><i class="fas fa-info mr-2" aria-hidden="true"></i> {{ __('seating.alert.closed') }}</div>
			@endif

			<div class="row">	
				<div class="col-lg-6">

					@if(Setting::get('SEATING_SHOW_MAP'))
						@include('seating.seatmap')
					@else
						<h2>{{ __('seating.closed') }}</h2>
						<p>{{ __('seating.checklater') }}</p>
					@endif

					<div class="alert alert-info" role="alert"><i class="fas fa-info mr-2" aria-hidden="true"></i> {!! __('seating.alert.tickets', ['url' => route('tickets')]) !!}</div>

				</div>

				<div class="col-lg-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">{{ __('seating.reservation.your') }}</h3>
							<div class="card-options">
								<span class="badge badge-default">{{Sentinel::getUser()->ownReservationsThisYear()->count().'/5'}}</span>
							</div>
						</div>
						<div class="card-body o-auto" style="height: 20rem">
							@if($reservations->count() == 0)
								<p><em>{{ __('seating.reservation.none') }}</em></p>
							@else
								<ul class="list-unstyled list-separated">
									@foreach($reservations as $reservation)
										<li class="list-separated-item">
											<div class="row align-items-center">
												<div class="col-auto">
													<span class="avatar brround avatar-md d-block" style="background-image: url({{ $reservation->reservedfor->profilepicturesmall ?? '/images/profilepicture/0.png' }})"></span>
												</div>
												<div class="col">
													<div>
														<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="text-inherit">{{ $reservation->seat->name }} - {{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a>
													</div>
													<small class="d-block item-except text-sm text-muted h-1x">
														@if(is_null($reservation->payment))
															<span class="badge badge-info" data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($reservation->created_at)->addDays(2)->format('Y-m-d H:i') }}"><i class="far fa-clock"></i> {{ __('seating.reservation.expires') }}: {{ SeatReservation::getExpireTime($reservation->id) }}</span>
														@endif
														@if(!is_null($reservation->payment))
															<span class="badge badge-success"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.paid') }}</span>
														@elseif($reservation->status_id == 1)
															<span class="badge badge-warning" data-toggle="tooltip" title="{{ __('seating.reservation.notpaidyetdesc') }}"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.notpaidyet') }}</span>
														@else
															<span class="badge badge-danger"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.notpaid') }}</span>
														@endif
														
														@if($reservation->reservedfor->age() < 15)
															<a href="{{ route('seating-consentform') }}" class="badge badge-dark popover-primary" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="{{ __('seating.reservation.consentform.desc') }}" data-original-title="{{ __('seating.reservation.consentform.why') }}"><i class="fas fa-user-tie"></i> {{ __('seating.reservation.consentform.title') }}</a>
														@endif
													</small>
												</div>
												<div class="col-auto">
													<div class="item-action dropdown">
														<a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="{{ route('seating-show', $reservation->seat->slug) }}"><i class="far fa-eye"></i> {{ __('seating.reservation.view') }}</a>
															@if($reservation->status_id != 1 and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-pay', $reservation->seat->slug) }}"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.pay') }}</a>
															@elseif($reservation->status_id == 1 and is_string(SeatReservation::getRealExpireTime($reservation->id)) and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-changepayment', $reservation->seat->slug) }}"><i class="fas fa-money-bill-wave"></i> {{ __('seating.reservation.changepayment') }}</a>
															@endif
															@if(!is_null($reservation->ticket) and Sentinel::getUser()->id == $reservation->reservedfor->id)
																<a class="dropdown-item" href="{{ route('seating-ticket-show', $reservation->seat->slug) }}"><i class="fas fa-ticket-alt"></i> {{ __('seating.reservation.ticket') }}</a>
																<a class="dropdown-item" href="{{ route('seating-ticket-download', $reservation->seat->slug) }}"><i class="far fa-file-pdf"></i> {{ __('seating.reservation.download') }}</a>
															@endif
															@if($reservation->reservedfor->age() < 15)
																<a class="dropdown-item" href="{{ route('seating-consentform') }}"><i class="fas fa-user-tie"></i> {{ __('seating.reservation.consentform.title') }}</a>
															@endif
															@if(is_string(SeatReservation::getRealExpireTime($reservation->id)) && $reservation->status_id != 1)
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{ route('seating-removereservation', $reservation->id) }}"><i class="fas fa-trash-alt"></i> {{ __('seating.reservation.remove') }}</a>
															@endif
														</div>
													</div>
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							@endif
						</div>
					</div>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">{{ __('seating.reservation.foryou') }}</h3>
						</div>
						<div class="card-body o-auto" style="height: 12rem">
							@if($ownreservations->count() == 0)
								<p><em>{{ __('seating.reservation.none') }}</em></p>
							@else
								<ul class="list-unstyled list-separated">
									@foreach($ownreservations as $reservation)
										<li class="list-separated-item">
											<div class="row align-items-center">
												<div class="col-auto">
													<span class="avatar brround avatar-md d-block" style="background-image: url({{ $reservation->reservedfor->profilepicturesmall ?? '/images/profilepicture/0.png' }})"></span>
												</div>
												<div class="col">
													<div>
														<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="text-inherit">{{ $reservation->seat->name }} - {{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a>
													</div>
													<small class="d-block item-except text-sm text-muted h-1x">
														@if(is_null($reservation->payment))
															<span class="badge badge-info" data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($reservation->created_at)->addDays(2)->format('Y-m-d H:i') }}"><i class="far fa-clock"></i> {{ __('seating.reservation.expires') }}: {{ SeatReservation::getExpireTime($reservation->id) }}</span>
														@endif
														@if(!is_null($reservation->payment))
															<span class="badge badge-success"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.paid') }}</span>
														@elseif($reservation->status_id == 1)
															<span class="badge badge-warning" data-toggle="tooltip" title="{{ __('seating.reservation.notpaidyetdesc') }}"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.notpaidyet') }}</span>
														@else
															<span class="badge badge-danger"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.notpaid') }}</span>
														@endif
														@if($reservation->reservedfor->age() < 15)
															<a href="{{ route('seating-consentform') }}" class="badge badge-dark popover-primary" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="{{ __('seating.reservation.consentform.desc') }}" data-original-title="{{ __('seating.reservation.consentform.why') }}"><i class="fas fa-user-tie"></i> {{ __('seating.reservation.consentform.title') }}</a>
														@endif
													</small>
												</div>
												<div class="col-auto">
													<div class="item-action dropdown">
														<a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="{{ route('seating-show', $reservation->seat->slug) }}"><i class="far fa-eye"></i> {{ __('seating.reservation.view') }}</a>
															@if($reservation->status_id != 1 and is_null($reservation->payment) && Sentinel::getUser()->id == $reservation->reservedby->id)
																<a class="dropdown-item" href="{{ route('seating-pay', $reservation->seat->slug) }}"><i class="fas fa-money-bill-alt"></i> {{ __('seating.reservation.pay') }}</a>
															@elseif($reservation->status_id == 1 and is_string(SeatReservation::getRealExpireTime($reservation->id)) and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-changepayment', $reservation->seat->slug) }}"><i class="fas fa-money-bill-wave"></i> {{ __('seating.reservation.changepayment') }}</a>
															@endif
															@if(!is_null($reservation->ticket) and Sentinel::getUser()->id == $reservation->reservedfor->id)
																<a class="dropdown-item" href="{{ route('seating-ticket-show', $reservation->seat->slug) }}"><i class="fas fa-ticket-alt"></i> {{ __('seating.reservation.ticket') }}</a>
																<a class="dropdown-item" href="{{ route('seating-ticket-download', $reservation->seat->slug) }}"><i class="far fa-file-pdf"></i> {{ __('seating.reservation.download') }}</a>
															@endif
															@if($reservation->reservedfor->age() < 15)
																<a class="dropdown-item" href="{{ route('seating-consentform') }}"><i class="fas fa-user-tie"></i> {{ __('seating.reservation.consentform.title') }}</a>
															@endif
															@if(is_string(SeatReservation::getRealExpireTime($reservation->id)) && $reservation->status_id != 1 && Sentinel::getUser()->id == $reservation->reservedby->id)
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{ route('seating-removereservation', $reservation->id) }}"><i class="fas fa-trash-alt"></i> {{ __('seating.reservation.remove') }}</a>
															@endif
														</div>
													</div>
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop