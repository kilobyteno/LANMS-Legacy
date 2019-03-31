<div class="seatmap">
	<ul>
		<li class="scene">{{ trans('seating.map.scene') }}</li>
		<li class="seat entrance" id="entrance"><p><a data-toggle="tooltip" title="{{ trans('seating.map.exit') }}"><i class="fas fa-door-open"></i></a></p></li>

		@foreach(\LANMS\SeatRows::all() as $row)

			<li class="seat-row">
				<ul class="seat-row-{{$row->slug}}">
					@if($row->slug == 'a')
						<li class="seat kiosk" id="kiosk"><p><a data-toggle="tooltip" title="{{ trans('seating.map.kiosk') }}"><i class="fas fa-coffee"></i></a></p></li>
					@endif
					@foreach($row->seats as $seat)
						<li class="seat @if($seat->reservationThisYear) @if($seat->reservationThisYear->status->id == 1) seat-reserved @elseif($seat->reservationThisYear->status->id == 2) seat-tempreserved @endif @if(Sentinel::getUser()->id == $seat->reservationThisYear->reservedfor->id && $seat->reservationThisYear->status->id == 1) seat-yours @endif @if(!is_null($seat->reservationThisYear->ticket)) @if(!is_null($seat->reservationThisYear->ticket->checkin)) checkedin @endif @endif @endif @if(Request::segment(4) == $seat->slug) active @endif">
							<p>
								@if(is_null($seat->reservationThisYear))
									<a href="{{ route('admin-seating-reservation-show', $seat->slug) }}" data-toggle="tooltip" title="{{ trans('seating.map.available') }}">{{ $seat->name }}</a>
								@elseif(Sentinel::getUser()->id == $seat->reservationThisYear->reservedfor->id && $seat->reservationThisYear->status->id == 1)
									<a href="{{ route('admin-seating-reservation-edit', $seat->reservationThisYear->id) }}" data-toggle="tooltip" title="{{ trans('seating.map.you') }}">{{ $seat->name }}</a>
								@elseif($seat->reservationThisYear->status->id == 1)
									<a href="{{ route('admin-seating-reservation-edit', $seat->reservationThisYear->id) }}" data-toggle="tooltip" title="{{ trans('seating.map.reservedfor') }}: {{ User::getUsernameAndFullnameByID($seat->reservationThisYear->reservedfor->id) }}">{{ $seat->name }}</a>
								@elseif($seat->reservationThisYear->status->id == 2)
									<a href="{{ route('admin-seating-reservation-edit', $seat->reservationThisYear->id) }}" data-toggle="tooltip" title="{{ trans('seating.map.tempreserved') }}: {{ User::getUsernameAndFullnameByID($seat->reservationThisYear->reservedfor->id) }}">{{ $seat->name }}</a>
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