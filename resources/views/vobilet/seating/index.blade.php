@extends('layouts.main')
@section('title', 'Seating')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Seating</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item active" aria-current="page">Seating</li>
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
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Your Reservations</h3>
						</div>
						<div class="card-body o-auto" style="height: 15rem">
							@if($reservations->count() == 0)
								<p><em>You haven't reserved any seats...</em></p>
							@else
								<ul class="list-unstyled list-separated">
									@foreach($reservations as $reservation)
										<li class="list-separated-item">
											<div class="row align-items-center">
												<div class="col-auto">
													<span class="avatar brround avatar-md d-block" style="background-image: url({{ $reservation->reservedfor->profilepicturesmall or '/images/profilepicture/0.png' }})"></span>
												</div>
												<div class="col">
													<div>
														<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="text-inherit">{{ $reservation->seat->name }} - {{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a>
													</div>
													<small class="d-block item-except text-sm text-muted h-1x">
														@if(is_null($reservation->payment))
															<span class="badge badge-info" data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($reservation->created_at)->addDays(2)->format('Y-m-d H:i') }}"><i class="far fa-clock"></i> Expires: {{ SeatReservation::getExpireTime($reservation->id) }}</span>
														@endif
														@if(!is_null($reservation->payment))
															<span class="badge badge-success"><i class="fas fa-money-bill-alt"></i> Paid</span>
														@elseif($reservation->status_id == 1)
															<span class="badge badge-warning" data-toggle="tooltip" title="Pay at the Entrance"><i class="fas fa-money-bill-alt"></i> Not paid yet</span>
														@else
															<span class="badge badge-danger"><i class="fas fa-money-bill-alt"></i> Not paid</span>
														@endif
														@if($reservation->reservedfor->age() < 16)
															<a href="{{ route('seating-consentform') }}" class="badge badge-dark popover-primary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Personen som denne reservasjonen er reservert for er under 16 år og må ha med samtykkeskjema, ferdig utfyllt ved innskjekking på arrangementet." data-original-title="Hvorfor ser jeg denne?"><i class="fas fa-user-tie"></i> Samtykkeskjema</a>
														@endif
													</small>
												</div>
												<div class="col-auto">
													<div class="item-action dropdown">
														<a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="{{ route('seating-show', $reservation->seat->slug) }}"><i class="far fa-eye"></i> View</a>
															@if($reservation->status_id != 1 and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-pay', $reservation->seat->slug) }}"><i class="fas fa-money-bill-alt"></i> Pay now</a>
															@elseif($reservation->status_id == 1 and SeatReservation::getRealExpireTime($reservation->id) <> "expired" and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-changepayment', $reservation->seat->slug) }}"><i class="fas fa-money-bill-wave"></i> Change payment</a>
															@endif
															@if(!is_null($reservation->ticket) and Sentinel::getUser()->id == $reservation->reservedfor->id)
																<a class="dropdown-item" href="{{ route('seating-ticket-download', $reservation->seat->slug) }}"><i class="fas fa-ticket-alt"></i> Download Ticket</a>
															@endif
															@if($reservation->reservedfor->age() < 16)
																<a class="dropdown-item" href="{{ route('seating-consentform') }}"><i class="fas fa-user-tie"></i> Samtykkeskjema</a>
															@endif
															@if(SeatReservation::getRealExpireTime($reservation->id) <> "expired" && $reservation->status_id != 1)
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{ route('seating-removereservation', $reservation->id) }}"><i class="fas fa-trash-alt"></i> Remove reservation</a>
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
							<h3 class="card-title">Seat reserved for you</h3>
						</div>
						<div class="card-body o-auto" style="height: 15rem">
							@if($ownreservations->count() == 0)
								<p><em>You haven't reserved any seats...</em></p>
							@else
								<ul class="list-unstyled list-separated">
									@foreach($ownreservations as $reservation)
										<li class="list-separated-item">
											<div class="row align-items-center">
												<div class="col-auto">
													<span class="avatar brround avatar-md d-block" style="background-image: url({{ $reservation->reservedfor->profilepicturesmall or '/images/profilepicture/0.png' }})"></span>
												</div>
												<div class="col">
													<div>
														<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="text-inherit">{{ $reservation->seat->name }} - {{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a>
													</div>
													<small class="d-block item-except text-sm text-muted h-1x">
														@if(is_null($reservation->payment))
															<span class="badge badge-info" data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($reservation->created_at)->addDays(2)->format('Y-m-d H:i') }}"><i class="far fa-clock"></i> Expires: {{ SeatReservation::getExpireTime($reservation->id) }}</span>
														@endif
														@if(!is_null($reservation->payment))
															<span class="badge badge-success"><i class="fas fa-money-bill-alt"></i> Paid</span>
														@elseif($reservation->status_id == 1)
															<span class="badge badge-warning" data-toggle="tooltip" title="Pay at the Entrance"><i class="fas fa-money-bill-alt"></i> Not paid yet</span>
														@else
															<span class="badge badge-danger"><i class="fas fa-money-bill-alt"></i> Not paid</span>
														@endif
														@if($reservation->reservedfor->age() < 16)
															<a href="{{ route('seating-consentform') }}" class="badge badge-dark popover-primary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Du er under 16 år og må ha med samtykkeskjema, ferdig utfyllt ved innskjekking på arrangementet." data-original-title="Hvorfor ser jeg denne?"><i class="fas fa-user-tie"></i> Samtykkeskjema</a>
														@endif
													</small>
												</div>
												<div class="col-auto">
													<div class="item-action dropdown">
														<a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="{{ route('seating-show', $reservation->seat->slug) }}"><i class="far fa-eye"></i> View</a>
															@if($reservation->status_id != 1 and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-pay', $reservation->seat->slug) }}"><i class="fas fa-money-bill-alt"></i> Pay now</a>
															@elseif($reservation->status_id == 1 and SeatReservation::getRealExpireTime($reservation->id) <> "expired" and is_null($reservation->payment))
																<a class="dropdown-item" href="{{ route('seating-changepayment', $reservation->seat->slug) }}"><i class="fas fa-money-bill-wave"></i> Change payment</a>
															@endif
															@if(!is_null($reservation->ticket) and Sentinel::getUser()->id == $reservation->reservedfor->id)
																<a class="dropdown-item" href="{{ route('seating-ticket-download', $reservation->seat->slug) }}"><i class="fas fa-ticket-alt"></i> Download Ticket</a>
															@endif
															@if($reservation->reservedfor->age() < 16)
																<a class="dropdown-item" href="{{ route('seating-consentform') }}"><i class="fas fa-user-tie"></i> Samtykkeskjema</a>
															@endif
															@if(SeatReservation::getRealExpireTime($reservation->id) <> "expired" && $reservation->status_id != 1)
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{ route('seating-removereservation', $reservation->id) }}"><i class="fas fa-trash-alt"></i> Remove reservation</a>
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