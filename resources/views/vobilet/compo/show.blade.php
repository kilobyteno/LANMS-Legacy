@extends('layouts.main')
@section('title', $compo->name)
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
				</div>
				<div class="card-body d-flex flex-column">
					@if($compo->start_at)<p>{{ trans('compo.starts') }}: <br>{{ \Carbon\Carbon::parse($compo->start_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->last_sign_up_at)<p>{{ trans('compo.lastsignup') }}: <br>{{ \Carbon\Carbon::parse($compo->last_sign_up_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->end_at)<p>{{ trans('compo.ends') }}: <br>{{ \Carbon\Carbon::parse($compo->end_at)->isoFormat('LLL') }}</p>@endif
					@if($compo->description)<div class="text-muted">{{ $compo->description }}</div>@endif
					<p>{{ trans('compo.type') }}: {{ trans('compo.type'.$compo->type) }}</p>
					<p>{{ trans('compo.signup_type') }}: {{ trans('compo.signup_type'.$compo->signup_type) }}</p>
					<p>{{ trans('compo.signup_size') }}: {{ trans('compo.signup_size'.$compo->signup_size) }}</p>
				</div>
				<div class="card-footer">
					@if($compo->rules)<a class="btn btn-sm btn-warning" href="{{ route('page', $compo->rules->slug) }}"><i class="fas fa-book"></i> {{ trans('compo.rules') }}</a>@endif
					@if($compo->last_sign_up_at > \Carbon\Carbon::now())<a class="btn btn-sm btn-success" href=""><i class="fas fa-user-plus"></i> {{ trans('compo.signup') }}</a>@endif
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-9 col-xl-9">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('compo.brackets') }}</h3>
				</div>
				<div class="card-body d-flex flex-column">
					@if($compo->challonge_url)
						<iframe src="https://{{ $compo->challonge_subdomain.'.' ?? ''}}challonge.com/{{ $compo->challonge_url }}/module?theme=6844&multiplier=0.9&match_width_multiplier=1.2&show_final_results=1" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>
					@else
						<p>{{ trans('compo.nobracketsyet') }}</p>
					@endif
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
@stop