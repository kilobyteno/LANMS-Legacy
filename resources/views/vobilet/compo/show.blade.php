@extends('layouts.main')
@section('title', $compo->name.' '.trans('header.compo'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ $compo->name }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo') }}">{{ trans('header.compo') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $compo->name }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('compo.info') }}</h3>
					<div class="card-options">
						@if($compo->rules)<a class="btn btn-sm btn-orange float-right" href="{{ route('page', $compo->rules->slug) }}"><i class="fas fa-book"></i> {{ trans('compo.rules') }}</a>@endif
					</div>
				</div>
				<div class="card-body d-flex flex-column">
					@if($compo->start_at)<p>{{ trans('compo.starts') }}: <br>{{ \Carbon\Carbon::parse($compo->start_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->last_sign_up_at)<p>{{ trans('compo.lastsignup') }}: <br>{{ \Carbon\Carbon::parse($compo->last_sign_up_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->end_at)<p>{{ trans('compo.ends') }}: <br>{{ \Carbon\Carbon::parse($compo->end_at)->isoFormat('LLL') }}</p>@endif
					<p>{{ trans('compo.type') }}: <br>{{ trans('compo.type.'.$compo->type) }}</p>
					<p>{{ trans('compo.signup_type') }}: <br>{{ trans('compo.signup_type.'.$compo->signup_type) }}</p>
					<p>{{ trans('compo.signup_size') }}: <br>{{ $compo->signup_size }} {{ trans_choice('compo.players', $compo->signup_size) }}</p>
					@if($compo->description)<div class="text-muted">{{ $compo->description }}</div>@endif
				</div>
				<div class="card-footer">
					@if($compo->last_sign_up_at > \Carbon\Carbon::now() && !\Sentinel::check()->composignups()->where('compo_id', $compo->id)->first())<a class="btn btn-sm btn-success" href="{{ route('compo-signup', $compo->slug) }}"><i class="fas fa-user-plus"></i> {{ trans('compo.signup.title') }}</a>@elseif(\Sentinel::check()->composignups()->where('compo_id', $compo->id)->first()) <a class="btn btn-sm btn-success disabled"><i class="fas fa-user-check"></i> {{ trans_choice('compo.signup.signedup', $compo->type) }}</a>@endif
					{{-- @if(\Carbon\Carbon::now() > $compo->start_at && \Carbon\Carbon::now() < $compo->end_at)<a class="btn btn-sm btn-lime" href=""><i class="fas fa-file-import"></i> {{ trans('compo.submit') }}</a>@endif --}}
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-9 col-xl-9">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('compo.type.'.$compo->type) }}</h3>
				</div>
				<div class="card-body d-flex flex-column">
					@if($compo->type == 1)
						@if($compo->challonge_url)
							<iframe src="https://{{ $compo->challonge_subdomain.'.' ?? ''}}challonge.com/{{ $compo->challonge_url }}/module?theme=6844&multiplier=0.9&match_width_multiplier=1.2&show_final_results=1" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>
						@else
							<p>{{ trans('compo.nobracketsyet') }}</p>
						@endif
					@elseif($compo->type == 2)
						{{-- <p>*insert submission stuff here*</p> --}}
					@endif
				</div>
			</div>
			@if($compo->signups->count() > 0)
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">{{ trans('compo.attendees') }}</h3>
					</div>
					<div class="card-body d-flex flex-column">
						<div class="row"> 
							@foreach($compo->signupsthisYear as $signup)
								@if($signup->team_id)
									<div class="col-lg-3">{{ $signup->team->name }}</div>
								@elseif(!$signup->team_id && $signup->user_id)
									<div class="col-lg-3">{{ \LANMS\User::getFullnameAndNicknameByID($signup->user_id) }}</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		$('.adform-adbox').remove();
	</script>
@stop