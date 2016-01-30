@extends('layouts.main')
@section('title', 'Seat - '.$currentseat->name)
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-md-12">

			<h1>Seat - {{ $currentseat->name }}</h1>

			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li><a href="{{ route('seating') }}">Seating</a></li>
				<li class="active"><strong>Seat - {{ $currentseat->name }}</strong></li>
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
															<a href="{{ URL::route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Available">{{ $seat->name }}</a>
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
				<div class="col-md-8">
					@if($currentseat->reservations->count() >=1)
						<div class="alert alert-info" role="alert">
							<strong>Information:</strong> This seat is {{ strtolower($currentseat->reservations->first()->status->name) }}.
						</div>
					@elseif(Sentinel::getUser()->reservations->count() >= 5)
						<div class="alert alert-warning" role="alert">
							<strong>Warning!</strong> You are not allowed to reserve more seats.
						</div>
					@elseif($currentseat->row_id <> 1)
						<form class="form-horizontal" method="post" action="{{ route('seating-reserve', $currentseat->slug) }}">
							<div class="form-group">
								<label class="col-sm-2 control-label">
									Reserved for
								</label>
								<div class="col-sm-10 @if($errors->has('reservedfor')) has-error @endif">
									<input type="text" class="form-control" id="username" value="{{ Sentinel::getUser()->username.' ('.Sentinel::getUser()->firstname.')' }}" autocomplete="off">
									<input type="text" class="hidden" id="reservedfor" name="reservedfor" value="{{ Sentinel::getUser()->id }}">
									@if($errors->has('reservedfor'))
										<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="btn btn-success"><i class="fa fa-hand-paper-o"></i> Reserve Seat</button>
								</div>
							</div>
						</form>
					@else
						<div class="alert alert-info" role="alert">
							<strong>Information:</strong> This seat cannot be reserved!
						</div>
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
						console.log(item.value);
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