@extends('layouts.main')
@section('title', 'Crew')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li class="active"><strong>Crew</strong></li>
			</ol>

			@foreach($crewcategories as $crewcategory)
				<h1>{{ $crewcategory->title }}</h1>
				@foreach($crewcategory->crew as $crew)
					<h3>
						<a href="{{ route('user-profile', $crew->user->username) }}">{{ User::getFullnameByID($crew->user->id) }} ({{$crew->user->username}})</a>
						@foreach($crew->skillattached as $skilla)
							@foreach($skilla->skill as $skill)
								<small><span class="{{ $skill->label }}"><i class="{{ $skill->icon }}"></i> {{ $skill->title }}</span></small>
							@endforeach
						@endforeach
					</h3>
				@endforeach
				<br>
			@endforeach

		</div>
	</div>
</div>
@stop