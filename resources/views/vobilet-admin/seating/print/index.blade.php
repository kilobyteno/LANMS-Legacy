@extends('layouts.main')
@section('title', 'Print Seat - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Print Seat</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Print Seat</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				@section('css')
					<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
				@stop
				<div class="seatmap">
					<ul>
						<li class="scene">{{ trans('seating.map.scene') }}</li>
						<li class="entrance" id="entrance"><a data-toggle="tooltip" title="{{ trans('seating.map.exit') }}"><i class="fas fa-door-open"></i></a></li>

						@foreach($rows as $row)

							<li class="seat-row">
								<ul class="seat-row-{{$row->slug}}">
									@if($row->slug == 'a')
										<li class="seat kiosk" id="kiosk"><a data-toggle="tooltip" title="{{ trans('seating.map.kiosk') }}"><i class="fa fa-coffee"></i></a></li>
									@endif
									@foreach($row->seats as $seat)
									
										<li class="seat @if($seat->reservationsThisYear()->count() > 0) @if($seat->reservationsThisYear()->first()->status->id == 1) seat-reserved @elseif($seat->reservationsThisYear()->first()->status->id == 2) seat-tempreserved @endif @if(Sentinel::getUser()->id == $seat->reservationsThisYear()->first()->reservedfor->id and $seat->reservationsThisYear()->first()->status->id == 1) seat-yours @endif  @endif @if(Request::segment(4) == $seat->slug) active @endif ">
											<p>
												@if($seat->reservationsThisYear()->count() == 0)
													<a href="{{ route('admin-seating-print-seat', $seat->slug) }}" data-toggle="tooltip" title="{{ trans('seating.map.available') }}">{{ $seat->name }}</a>
												@elseif(Sentinel::getUser()->id == $seat->reservationsThisYear()->first()->reservedfor->id and $seat->reservationsThisYear()->first()->status->id == 1)
													<a href="{{ route('admin-seating-print-seat', $seat->slug) }}" data-toggle="tooltip" title="{{ trans('seating.map.you') }}">{{ $seat->name }}</a>
												@elseif($seat->reservationsThisYear()->first()->status->id == 1)
													<a href="{{ route('admin-seating-print-seat', $seat->slug) }}" data-toggle="tooltip" title="{{ trans('seating.map.reservedfor') }}: {{ User::getUsernameAndFullnameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}">{{ $seat->name }}</a>
												@elseif($seat->reservationsThisYear()->first()->status->id == 2)
													<a href="{{ route('admin-seating-print-seat', $seat->slug) }}" data-toggle="tooltip" title="{{ trans('seating.map.tempreserved') }}: {{ User::getUsernameAndFullnameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}">{{ $seat->name }}</a>
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
		</div>
	</div>
</div>
@stop