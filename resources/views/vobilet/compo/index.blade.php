@extends('layouts.main')
@section('title', trans('header.compo'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('header.compo') }}<a class="btn btn-sm btn-info ml-2" href="{{ route('compo-team') }}"><i class="fa fa-user-shield mr-2"></i> {{ trans('compo.teams') }}</a></h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('header.compo') }}</li>
		</ol>
	</div>
	<div class="row">
		@if(count($compos) > 0)
				@foreach($compos as $compo)
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">{{ $compo->name }}</h3>
						</div>
						<div class="card-body d-flex flex-column">
							@if($compo->start_at)<p>{{ trans('compo.starts') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->start_at)->isoFormat('LLL') }}">{{ $compo->start_at->diffForHumans() }}</span></p>@endif
							@if($compo->last_sign_up_at)<p>{{ trans('compo.lastsignup') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->last_sign_up_at)->isoFormat('LLL') }}">{{ $compo->last_sign_up_at->diffForHumans() }}</span></p>@endif
							@if($compo->end_at)<p>{{ trans('compo.ends') }}: <span data-toggle="tooltip" title="{{ \Carbon\Carbon::parse($compo->end_at)->isoFormat('LLL') }}">{{ $compo->end_at->diffForHumans() }}</span></p>@endif
							<p>{{ trans('compo.type') }}: {{ trans('compo.type.'.$compo->type) }}</p>
							<p>{{ trans('compo.signup_type') }}: {{ trans('compo.signup_type.'.$compo->signup_type) }}</p>
							<p>{{ trans('compo.signup_size') }}: {{ $compo->signup_size }} {{ trans_choice('compo.players', $compo->signup_size) }}</p>
							@if($compo->description)<div class="text-muted">{{ $compo->description }}</div>@endif

						</div>
						<div class="card-footer">
							<a class="btn btn-sm btn-info" href="{{ route('compo-show', $compo->slug) }}"><i class="far fa-eye"></i> {{ trans('global.view') }}</a>
							@if($compo->rules)<a class="btn btn-sm btn-orange" href="{{ route('page', $compo->rules->slug) }}"><i class="fas fa-book"></i> {{ trans('compo.rules') }}</a>@endif
							@if($compo->last_sign_up_at > \Carbon\Carbon::now())<a class="btn btn-sm btn-success" href=""><i class="fas fa-user-plus"></i> {{ trans('compo.signup') }}</a>@endif
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="col-md-12 col-lg-12 col-sm-12">
				<p>{{ trans('global.nodata') }}</p>
			</div>
		@endif
	</div>
</div>

@stop