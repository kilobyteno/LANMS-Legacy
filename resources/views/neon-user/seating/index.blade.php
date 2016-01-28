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
				<div class="alert alert-warning" role="alert"> <strong>WARNING!</strong> It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address.</div>
			@endif

			<div class="row">	
				<div class="col-md-4">
					@if(Setting::get('APP_SEATING_SHOW_MAP'))
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
												<li class="seat">
													<p>
														@if($seat->status == 2)
															<a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="top">{{ $seat->name }}</a>
															<div class="popover-content hidden">
																<p>Reserved for: {{ User::getUsernameByID($seat->used_by) }}</p>
															</div>
														@elseif($seat->status == 1)
															<a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="top">{{ $seat->name }}</a>
															<div class="popover-content hidden">
																<p>Temporary Reserved By: {{ User::getUsernameByID($seat->reserved_by) }}</p>
															</div>
														@elseif($seat->status == 0)
															@if(Setting::get('SEATING_OPEN') && $seat->row_id <> 1)
																<a href="javascript:void(0)" class="popper" data-toggle="popover">{{ $seat->name }}</a>
																<div class="popper-content hidden">
																	<p><a href="{{ URL::route('seating-reserve', $seat->name) }}">Reserver</a></p>
																</div>
															@else
																{{ $seat->name }}
															@endif
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
				@if(Setting::get('APP_SEATING_OPEN'))
					<div class="col-md-4">
						<h3>Seats you have reserved:</h3>
					</div>

					<div class="col-md-4">
						<h3>Seats you administer:</h3>
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