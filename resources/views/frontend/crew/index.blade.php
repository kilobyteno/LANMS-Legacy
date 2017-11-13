@extends('layouts.main')
@section('title', 'Crew')

@section('content')

<div class="container">

	<div class="row latest-posts">
		<div class="col s12">

			@foreach($crewcategories as $crewcategory)
				<h1>{{ $crewcategory->title }}</h1>
				@foreach($crewcategory->crewThisYear as $crew)
					<h5>
						<a href="{{ route('user-profile', $crew->user->username) }}">{{ User::getFullnameAndNicknameByID($crew->user->id) }}</a>
						@foreach($crew->skillattached as $skilla)
							@foreach($skilla->skill as $skill)
								<small><span class="{{ $skill->label }}"><i class="{{ $skill->icon }}"></i> {{ $skill->title }}</span></small>
							@endforeach
						@endforeach
					</h5>
				@endforeach
			@endforeach

		</div>
	</div>

@endsection
