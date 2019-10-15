@extends('layouts.auth')
@section('title', trans('auth.activate.title'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_LIGHT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-activate-post', $activation_code) }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ trans('auth.activate.title') }}</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<input type="text" class="form-control" value="{{ $activation_code }}" readonly>
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('auth.activate.username') }}</label>
						<input type="text" class="form-control" name="username" placeholder="Confirm email or username" autocomplete="off">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-success btn-block">{{ trans('auth.activate.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{!! trans('auth.activate.forgetit', ['url' => route('account-signin')]) !!}
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop