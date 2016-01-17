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

			<div class="row">	
				<div class="col-md-4">

					<div class="seatmap">
						<ul>
							<li class="scene">Scene</li>
							<li class="entrance"><p><span class="fa fa-sign-in"></span></p></li>
							@foreach($rows as $row)
								<li class="seat-row">
									<ul class="seat-row-{{$row->slug}}">
										@if($row->slug == 'a')
											<li class="seat kiosk"><p><span class="fa fa-coffee"></span></p></li>
										@endif
										@foreach($row->seats as $seat)
											<li class="seat">
												<p>
													{{ $seat->name }}
												</p>
											</li>
										@endforeach
									</ul>
								</li>
							@endforeach
						</ul>
					</div>

				</div>
				<div class="col-md-4">
					<h3>Seats you have reserved:</h3>
				</div>

				<div class="col-md-4">
					<h3>Seats you administer:</h3>
				</div>
			</div>

		</div>
	</div>
</div>
@stop