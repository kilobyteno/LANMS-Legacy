@extends('layouts.main')
@section('title', __('compo.signup.title').' - '.$compo->name.' - '.__('header.compo'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('compo.signup.title') }}: <small>{{ $compo->name }}</small></h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo') }}">{{ __('header.compo') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo-show', $compo->slug) }}">{{ $compo->name }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('compo.signup.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('compo.info') }}</h3>
					<div class="card-options">
						@if($compo->rules)<a class="btn btn-sm btn-orange float-right" href="{{ route('page', $compo->rules->slug) }}"><i class="fas fa-book"></i> {{ __('compo.rules') }}</a>@endif
					</div>
				</div>
				<div class="card-body d-flex flex-column">
					<p class="mb-5 pb-5 border-bottom">
						<small>
							@if(\Carbon\Carbon::now() < $compo->start_at)
								<span class="badge badge-default"><i class="fas fa-hourglass-start"></i> {{ __('compo.notstarted') }}</span>
							@elseif(\Carbon\Carbon::now() > $compo->start_at && \Carbon\Carbon::now() < $compo->end_at)
								<span class="badge badge-info"><i class="fas fa-hourglass-half"></i> {{ __('compo.started') }}</span>
							@elseif($compo->end_at < \Carbon\Carbon::now())
								<span class="badge badge-success"><i class="fas fa-hourglass-end"></i> {{ __('compo.finished') }}</span>
							@endif
							@if($compo->min_signups && $compo->signupsThisYear->count() < $compo->min_signups)
								<span class="tag tag-yellow"><i class="fas fa-thermometer-quarter"></i> {{ __('compo.signup.missingattendance') }}</span>
							@endif
							@if($compo->max_signups && $compo->signupsThisYear->count() >= $compo->max_signups)
								<span class="badge badge-danger"><i class="fas fa-thermometer-full"></i> {{ __('compo.signup.full') }}</span>
							@endif
							@if($compo->prize_pool_total)
								<span class="tag tag-lime"><i class="fas fa-money-bill-alt mr-2"></i>{{ $compo->prize_pool_total }}</span>
							@endif
						</small>
					</p>
					@if($compo->first_sign_up_at)<p>{{ __('compo.firstsignup') }}: <br>{{ \Carbon\Carbon::parse($compo->first_sign_up_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->last_sign_up_at)<p>{{ __('compo.lastsignup') }}: <br>{{ \Carbon\Carbon::parse($compo->last_sign_up_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->start_at)<p>{{ __('compo.starts') }}: <br>{{ \Carbon\Carbon::parse($compo->start_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->end_at)<p>{{ __('compo.ends') }}: <br>{{ \Carbon\Carbon::parse($compo->end_at)->isoFormat('LLL') }}</p>@endif
					<p>{{ __('compo.type') }}: <br>{{ __('compo.type.'.$compo->type) }}</p>
					<p>{{ __('compo.signup_type') }}: <br>{{ __('compo.signup_type.'.$compo->signup_type) }}</p>
					<p>{{ __('compo.signup_size') }}: <br>{{ $compo->signup_size }} {{ trans_choice('compo.players', $compo->signup_size) }}</p>
					@if($compo->min_signups)<p>{{ __('compo.min_signups') }}: <br>{{ $compo->min_signups }}</p>@endif
					@if($compo->max_signups)<p>{{ __('compo.max_signups') }}: <br>{{ $compo->max_signups }}</p>@endif
					<p>{{ __('compo.nuber_of_participants') }}: {{ $compo->signupsThisYear->count() }}</p>
					@if($compo->description)<div class="text-muted">{{ $compo->description }}</div>@endif
					@if($compo->prize_pool_first || $compo->prize_pool_second || $compo->prize_pool_third)
						<p>{{ __('compo.prize_pool') }}:<br>
							{!! $compo->prize_pool_first ? '1. '.$compo->prize_pool_first.'<br>' : '' !!}
							{!! $compo->prize_pool_second ? '2. '.$compo->prize_pool_second.'<br>' : '' !!}
							{!! $compo->prize_pool_third ? '3. '.$compo->prize_pool_third.'<br>' : '' !!}
						</p>
					@endif
				</div>
				{{-- <div class="card-footer">
					@if(\Carbon\Carbon::now() > $compo->start_at && \Carbon\Carbon::now() < $compo->end_at)<a class="btn btn-sm btn-lime" href=""><i class="fas fa-file-import"></i> {{ __('compo.submit') }}</a>@endif 
				</div>--}}
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-9 col-xl-9">
			<form class="card" role="form" method="post" action="{{ route('compo-signup-store', $compo->slug) }}">
				<div class="card-header">
					<h3 class="card-title">{{ __('compo.signup.title') }}</h3>
				</div>
				<div class="card-body d-flex flex-column">
					@if($compo->signup_type == 1)
						<div class="form-group">
							<label class="form-label">{{ __('compo.signup.chooseteam') }}</label>
							<select name="team" class="select2">
								<option value="">-- {{ __('global.pleaseselect') }} --</option>
								@foreach(\LANMS\CompoTeam::where('user_id', \Sentinel::check()->id)->get() as $team)
									<option value="{{ $team->id }}">{{ $team->name }}</option>
								@endforeach
							</select>
						</div>
					@else
						<p>{{ __('compo.signup.invidual') }}</p>
						<input type="hidden" name="id" value="{{ \Sentinel::check()->id }}">
					@endif
					<div class="input-group">
						<label class="custom-switch">
							<input type="checkbox" class="custom-switch-input" name="read_rules">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">{!! trans_choice('compo.signup.agreement', $compo->type) !!}</span>
						</label>
					</div>
				</div>
				<div class="card-footer">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i> {{ __('compo.signup.title') }}</button>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		$('.adform-adbox').remove();
	</script>

	<script type="text/javascript">
		$(function(){
			$('.select2').select2({minimumResultsForSearch:-1});
		});
	</script>
@stop