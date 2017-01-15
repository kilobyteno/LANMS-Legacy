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
					
						<li class="seat @if($seat->reservationsThisYear()->count() > 0) @if($seat->reservationsThisYear()->first()->status->id == 1) seat-reserved @elseif($seat->reservationsThisYear()->first()->status->id == 2) seat-tempreserved @endif @if(Sentinel::getUser()->id == $seat->reservationsThisYear()->first()->reservedfor->id and $seat->reservationsThisYear()->first()->status->id == 1) seat-yours @endif  @endif @if(Request::segment(3) == $seat->slug) active @endif ">
							<p>
								@if($seat->reservationsThisYear()->count() == 0)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Available">{{ $seat->name }}</a>
								@elseif(Sentinel::getUser()->id == $seat->reservationsThisYear()->first()->reservedfor->id and $seat->reservationsThisYear()->first()->status->id == 1)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="This seat is reserved for you!">{{ $seat->name }}</a>
								@elseif($seat->reservationsThisYear()->first()->status->id == 1)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Reserved for: {{ User::getUsernameAndFullnameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}">{{ $seat->name }}</a>
								@elseif($seat->reservationsThisYear()->first()->status->id == 2)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Temporary Reserved By: {{ User::getUsernameAndFullnameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}">{{ $seat->name }}</a>
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