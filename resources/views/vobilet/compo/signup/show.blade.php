@extends('layouts.main')
@section('title', $compo->name.' '.trans('header.compo'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('compo.signup.title') }}: <small>{{ $compo->name }}</small></h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo') }}">{{ trans('header.compo') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo-show', $compo->slug) }}">{{ $compo->name }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('compo.signup.title') }}</li>
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
				{{-- <div class="card-footer">
					@if(\Carbon\Carbon::now() > $compo->start_at && \Carbon\Carbon::now() < $compo->end_at)<a class="btn btn-sm btn-lime" href=""><i class="fas fa-file-import"></i> {{ trans('compo.submit') }}</a>@endif 
				</div>--}}
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-9 col-xl-9">
			<form class="card" role="form" method="post" action="{{ route('compo-signup-store', $compo->slug) }}">
				<div class="card-header">
					<h3 class="card-title">{{ trans('compo.signup.title') }}</h3>
				</div>
				<div class="card-body d-flex flex-column">
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					@if($compo->type == 1)
						<div class="form-group">
							<label class="form-label">{{ trans('compo.team.create.name') }}</label>
							<select name="id" class="select2">
								<option value="">-- {{ trans('global.pleaseselect') }} --</option>
								@foreach(\LANMS\CompoTeam::where('user_id', \Sentinel::check()->id)->get() as $team)
									<option value="{{ $team->id }}">{{ $team->name }}</option>
								@endforeach
							</select>
						</div>
					@else
						<p>{{ trans('compo.signup.invidual') }}</p>
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
					<button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i> {{ trans('compo.signup.title') }}</button>
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
			$('.select2').select2();
		});
	</script>
@stop