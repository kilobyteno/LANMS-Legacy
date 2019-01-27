@extends('layouts.main')
@section('title', trans('header.crew'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('header.crew') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('header.crew') }}</li>
		</ol>
	</div>
	<div class="row">
		@foreach($crewcategories as $crewcategory)
			<div class="col-md-6 col-lg-6 col-sm-12">
				<h5>{{ $crewcategory->title }}</h5>
				<div class="row">
					@foreach($crewcategory->crewThisYear as $crew)
						<div class="col-md-6 col-lg-6 col-sm-12">
							<div class="card">
								<div class="card-body d-flex flex-column">
									<div class="text-muted"><small>
										@foreach($crew->skills as $skill)
											<span class="{{ $skill->label }}"><i class="{{ $skill->icon }}"></i> {{ $skill->title }}</span>
										@endforeach
									</small></div>
									<div class="d-flex align-items-center pt-5 mt-auto">
										<div class="avatar brround avatar-md mr-3" style="background-image: url({{ $crew->user->profilepicturesmall ?? '/images/profilepicture/0_small.png' }})"></div>
										<div><a href="{{ route('user-profile', $crew->user->username) }}" class="text-default">{{ User::getFullnameByID($crew->user->id) }}</a></div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
</div>

@stop