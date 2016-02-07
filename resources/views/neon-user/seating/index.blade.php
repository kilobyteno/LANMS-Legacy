@extends('layouts.main')
@section('title', 'Seating')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-md-12">

			<h1>Seating</h1>

			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li class="active"><strong>Seating</strong></li>
			</ol>

			@if(Sentinel::getUser()->addresses->count() == 0)
				<div class="alert alert-warning" role="alert"> <strong>WARNING!</strong> It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address. You should <a href="{{ route('account-addressbook-create') }}" class="alert-link">add</a> one.</div>
			@endif

			<div class="row">	
				<div class="col-md-4">

					@if(Setting::get('SEATING_SHOW_MAP'))
						@include('seating.seatmap')
					@else
						<h2>Seatmap is not available at this moment!</h2>
						<p>Please check back later...</p>
					@endif

				</div>
				@if(Setting::get('SEATING_OPEN'))
					<div class="col-md-4">
						<h3>Seats you have reserved:</h3>
						@if($reservations->count() == 0)
							<p><em>You haven't reserved any seats...</em></p>
						@endif
						@foreach($reservations as $reservation)
							<div class="member-entry">
								<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="member-img">
									<h3>{{ $reservation->seat->name }}</h3>
								</a>
								<div class="member-details">
									<h4>
										<a href="{{ route('user-profile', $reservation->reservedfor->username) }}">{{ $reservation->reservedfor->firstname }}@if($reservation->reservedfor->showname) {{ $reservation->reservedfor->lastname }}@endif</a>
									</h4>
									<div class="row info-list">
										<div class="col-sm-4">
											@if(!is_null($reservation->payment))
												<span class="text-success"><i class="fa fa-money"></i> Paid: Yes</span>
											@elseif($reservation->status_id == 1)
												<span class="text-danger" data-toggle="tooltip" title="Pay at the Entrance"><i class="fa fa-money"></i> Paid: No</span>
												@if(SeatReservation::getRealExpireTime($reservation->id) <> "expired")
													<a class="btn btn-warning btn-xs" href="{{ route('seating-changepayment', $reservation->seat->slug) }}">Change Payment</a>
												@endif
											@else
												<a class="btn btn-danger btn-xs" href="{{ route('seating-pay', $reservation->seat->slug) }}"><i class="fa fa-money"></i> Paid: No</a>
											@endif
										</div>
										@if(is_null($reservation->payment))
											<div class="col-sm-4">
												<i class="fa fa-clock-o"></i> Expires in: {{ SeatReservation::getExpireTime($reservation->id) }}
											</div>
										@endif
										<div class="col-sm-4">
											@if(!is_null($reservation->ticket) and Sentinel::getUser()->id == $reservation->reservedfor->id)
												<a href="{{ route('seating-ticket-download', $reservation->seat->slug) }}"><i class="fa fa-ticket"></i> Download Ticket</a>
											@endif
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="col-md-4">
						<h3>Seats reserved to you:</h3>
						@if($ownreservations->count() == 0)
							<p><em>There are no seats reserved to you...</em></p>
						@endif
						@foreach($ownreservations as $reservation)
							<div class="member-entry">
								<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="member-img">
									<h3>{{ $reservation->seat->name }}</h3>
								</a>
								<div class="member-details">
									<h4>
										<a href="{{ route('user-profile', $reservation->reservedfor->username) }}">{{ $reservation->reservedfor->firstname }}@if($reservation->reservedfor->showname) {{ $reservation->reservedfor->lastname }}@endif</a>
									</h4>
									<div class="row info-list">
										<div class="col-sm-4">
											@if(!is_null($reservation->payment))
												<span class="text-success"><i class="fa fa-money"></i> Paid: Yes</span>
											@elseif($reservation->status_id == 1)
												<span class="text-danger" data-toggle="tooltip" title="Pay at the Entrance"><i class="fa fa-money"></i> Paid: No</span>
												@if(SeatReservation::getRealExpireTime($reservation->id) <> "expired")
													<a class="btn btn-warning btn-xs" href="{{ route('seating-changepayment', $reservation->seat->slug) }}">Change Payment</a>
												@endif
											@else
												<a class="btn btn-danger btn-xs" href="{{ route('seating-pay', $reservation->seat->slug) }}"><i class="fa fa-money"></i> Paid: No</a>
											@endif
										</div>
										@if(is_null($reservation->payment))
											<div class="col-sm-4">
												<i class="fa fa-clock-o"></i> Expires in: {{ SeatReservation::getExpireTime($reservation->id) }}
											</div>
										@endif
										<div class="col-sm-4">
											@if(!is_null($reservation->ticket) and Sentinel::getUser()->id == $reservation->reservedfor->id)
												<a href="{{ route('seating-ticket-download', $reservation->seat->slug) }}"><i class="fa fa-ticket"></i> Download Ticket</a>
											@endif
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<div class="col-md-8 text-center">
						<div class="well well-lg">
							<h2>Seating has not started yet!</h2>
							<p>Please check back later...</p>
						</div>
					</div>
				@endif
			</div>

		</div>
	</div>
</div>
@stop