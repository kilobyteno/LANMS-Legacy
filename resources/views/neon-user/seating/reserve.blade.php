@extends('layouts.main')
@section('title', 'Reserve Seat - '.Request::segment(3))
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-md-12">

			<h1>Reserve Seat - {{ Request::segment(3) }}</h1>

			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li><a href="{{ route('seating') }}">Seating</a></li>
				<li class="active"><strong>Reserve Seat - {{ Request::segment(3) }}</strong></li>
			</ol>

			<div class="row">	
				<div class="col-md-4">

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
											<li class="seat @if(Request::is('user/seating/'.$seat->name.'/reserve'))active @endif">
												<p>
													@if($seat->status->name == "Reserved")
														<a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="top">{{ $seat->name }}</a>
														<div class="popover-content hidden">
															<p>Reserved for: {{ $seat->reservedfor }}</p>
														</div>
													@elseif($seat->status->name == "Temporary Reserved")
														<a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="top">{{ $seat->name }}</a>
														<div class="popover-content hidden">
															<p>Temporary Reserved By: N/A</p>
														</div>
													@elseif($seat->status->name == "Open")
														@if(Setting::get('APP_SEATING_OPEN') && $seat->row_id <> 1)
															<a href="{{ URL::route('seating-reserve', $seat->name) }}">{{ $seat->name }}</a>
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

				</div>
				<div class="col-md-8">
					@if($seat->reserved)
						<div class="alert alert-warning" role="alert">
							<strong>Warning!</strong> This seat has already been reserved.
						</div>
					@else
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label">
									Reserved for
								</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" value="{{ Sentinel::getUser()->username.' ('.Sentinel::getUser()->firstname.')' }}" autocomplete="off">
									<input type="text" class="hidden" id="reservedfor" name="reservedfor" value="{{ Sentinel::getUser()->id }}">
								</div>
							</div>
						</form>
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop

@section('javascript')
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#username').typeahead({
					onSelect: function(item) {
						document.getElementById("reservedfor").value = item.value;
					},
					ajax: {
						url: "/ajax/usernames",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop