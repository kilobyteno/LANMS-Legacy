@extends('layouts.main')
@section('title', 'Crew')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Crew</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item active" aria-current="page">Crew</li>
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
									<div class="text-muted">
										@foreach($crew->skillAttachedThisYear as $skilla)
											<small><span class="{{ $skilla->skill->label }}"><i class="{{ $skilla->skill->icon }}"></i> {{ $skilla->skill->title }}</span></small>
										@endforeach
									</div>
									<div class="d-flex align-items-center pt-5 mt-auto">
										<div class="avatar brround avatar-md mr-3" style="background-image: url({{ $crew->profilepicturesmall or '/images/profilepicture/0_small.png' }})"></div>
										<div><a href="{{ URL::route('user-profile', $crew->username) }}" class="text-default">{{ User::getFullnameByID($crew->id) }}</a></div>
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