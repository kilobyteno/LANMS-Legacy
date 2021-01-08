@extends('layouts.main')
@section('title', __('header.compo'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('header.compo') }}@if(\Sentinel::check())<a class="btn btn-sm btn-info ml-2" href="{{ route('compo-team') }}"><i class="fa fa-user-shield mr-2"></i> {{ __('compo.teams') }}</a>@endif</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('header.compo') }}</li>
		</ol>
	</div>
	<div class="row">
		@if(count($compos) > 0)
			@foreach($compos as $compo)
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">{{ $compo->name }}</h3>
							<div class="card-options">
								@if(\Sentinel::check())
									@if(\Sentinel::getUser()->composignups()->where('compo_id', $compo->id)->first())
										<small><span class="badge badge-info text-right"><i class="fas fa-user-check"></i> {{ trans_choice('compo.signup.signedup', $compo->signup_type) }}</span></small>
									@endif
								@endif
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
									@if($compo->min_signups && $compo->signupsThisYear->count() < $compo->min_signups && \Carbon\Carbon::now() < $compo->end_at)
										<span class="tag tag-yellow"><i class="fas fa-thermometer-quarter"></i> {{ __('compo.signup.missingattendance') }}</span>
									@endif
									@if($compo->max_signups && $compo->signupsThisYear->count() >= $compo->max_signups && \Carbon\Carbon::now() < $compo->end_at)
										<span class="badge badge-danger"><i class="fas fa-thermometer-full"></i> {{ __('compo.signup.full') }}</span>
									@endif
									@if($compo->prize_pool_total)
										<span class="tag tag-lime"><i class="fas fa-money-bill-alt mr-2"></i>{{ $compo->prize_pool_total }}</span>
									@endif
								</small>
							</p>
							@if($compo->first_sign_up_at)<p>{{ __('compo.firstsignup') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->first_sign_up_at)->isoFormat('LLL') }}">{{ $compo->first_sign_up_at->diffForHumans() }}</span></p>@endif
							@if($compo->last_sign_up_at)<p>{{ __('compo.lastsignup') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->last_sign_up_at)->isoFormat('LLL') }}">{{ $compo->last_sign_up_at->diffForHumans() }}</span></p>@endif
							@if($compo->start_at)<p>{{ __('compo.starts') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->start_at)->isoFormat('LLL') }}">{{ $compo->start_at->diffForHumans() }}</span></p>@endif
							@if($compo->end_at)<p>{{ __('compo.ends') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->end_at)->isoFormat('LLL') }}">{{ $compo->end_at->diffForHumans() }}</span></p>@endif
							<p>{{ __('compo.type') }}: {{ __('compo.type.'.$compo->type) }}</p>
							<p>{{ __('compo.signup_type') }}: {{ __('compo.signup_type.'.$compo->signup_type) }}</p>
							<p>{{ __('compo.signup_size') }}: {{ $compo->signup_size }} {{ trans_choice('compo.players', $compo->signup_size) }}</p>
							@if($compo->min_signups)<p>{{ __('compo.min_signups') }}: {{ $compo->min_signups }}</p>@endif
							@if($compo->max_signups)<p>{{ __('compo.max_signups') }}: {{ $compo->max_signups }}</p>@endif
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
						<div class="card-footer">
							<a class="btn btn-sm btn-info" href="{{ route('compo-show', $compo->slug) }}"><i class="far fa-eye"></i> {{ __('global.view') }}</a>
							@if($compo->rules)<a class="btn btn-sm btn-orange" href="{{ route('page', $compo->rules->slug) }}"><i class="fas fa-book"></i> {{ __('compo.rules') }}</a>@endif
							@if(\Sentinel::check())
								@if(\Carbon\Carbon::now() > $compo->first_sign_up_at && \Carbon\Carbon::now() < $compo->last_sign_up_at && !\Sentinel::getUser()->composignups()->where('compo_id', $compo->id)->first())
									@if($compo->max_signups)
										@if($compo->signupsThisYear->count() < $compo->max_signups)
											<a class="btn btn-sm btn-success" href="{{ route('compo-signup', $compo->slug) }}"><i class="fas fa-user-plus"></i> {{ __('compo.signup.title') }}</a>
										@endif
									@else
										<a class="btn btn-sm btn-success" href="{{ route('compo-signup', $compo->slug) }}"><i class="fas fa-user-plus"></i> {{ __('compo.signup.title') }}</a>
									@endif
								@endif
							@endif
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="col-md-12 col-lg-12 col-sm-12">
				<p>{{ __('global.nodata') }}</p>
			</div>
		@endif
		<div class="col-12">
			<a href="{{ route('compo-previous') }}" class="btn btn-outline-info"><i class="fas fa-history"></i> {{ __('compo.previous') }}</a>
		</div>
	</div>
</div>

@stop