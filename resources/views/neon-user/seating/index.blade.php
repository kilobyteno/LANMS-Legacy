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
						<div class="seatmap">
							<ul>
								<li class="scene">Scene</li>
								<li class="entrance" id="entrance"><p><span class="fa fa-sign-in"></span></p></li>
								@foreach($rows as $row)
									<li class="seat-row">
										<ul class="seat-row-{{$row->slug}}">
											@if($row->slug == 'a')
												<li class="seat kiosk" id="kiosk"><p><span class="fa fa-coffee"></span></p></li>
											@endif
											@foreach($row->seats as $seat)
												<li class="seat @if($seat->reservations->count() <> 0) @if($seat->reservations->first()->status->id == 1) seat-reserved @elseif($seat->reservations->first()->status->id == 2) seat-tempreserved @endif @if(Sentinel::getUser()->id == $seat->reservations->first()->reservedfor->id and $seat->reservations->first()->status->id == 1) seat-yours @endif @endif @if(Request::is('user/seating/'.$seat->slug)) active @endif ">
													<p>
														@if($seat->reservations->count() == 0)
															@if(Setting::get('SEATING_OPEN') && $seat->row_id <> 1)
																<a href="{{ URL::route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Available">{{ $seat->name }}</a>
															@else
																{{ $seat->name }}
															@endif
														@elseif(Sentinel::getUser()->id == $seat->reservations->first()->reservedfor->id and $seat->reservations->first()->status->id == 1)
															<a href="{{ URL::route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="This seat is reserved for you!">{{ $seat->name }}</a>
														@elseif($seat->reservations->first()->status->id == 1)
															<a href="{{ URL::route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Reserved for: {{ User::getUsernameAndFullnameByID($seat->reservations->first()->reservedfor->id) }}">{{ $seat->name }}</a>
														@elseif($seat->reservations->first()->status->id == 2)
															<a href="{{ URL::route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Temporary Reserved By: {{ User::getUsernameAndFullnameByID($seat->reservations->first()->reservedfor->id) }}">{{ $seat->name }}</a>
														@else
															{{ $seat->name }}
														@endif
													</p>
												</li>
											@endforeach
										</ul>
									</li>
								@endforeach
							</ul>
						</div>
					@else
						<h2>Seatmap is not available at this moment!</h2>
						<p>Please check back later...</p>
					@endif

				</div>
				@if(Setting::get('SEATING_OPEN'))
					<div class="col-md-4">
						<h3>Seats you have reserved:</h3>
						@foreach($userreservations as $reservation)
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
											@if($reservation->payment == null)
												<span class="text-danger"><a href="{{ route('seating-pay', $reservation->seat->slug) }}" class="text-danger"><i class="fa fa-money"></i> Paid: No</a></span>
											@else
												<span class="text-success"><i class="fa fa-money"></i> Paid: Yes</span>
											@endif
										</div>
										<div class="col-sm-4">
											<i class="fa fa-clock-o"></i> Expires in: {{ SeatReservation::getExpireTime($reservation->id) }}
										</div>
										<div class="col-sm-4">
											@if($reservation->ticket <> null)
												<a href="{{ route('seating-ticket-download', $reservation->ticket->id) }}"><i class="fa fa-ticket"></i> Download Ticket</a>
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