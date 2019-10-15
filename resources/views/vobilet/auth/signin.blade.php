@extends('layouts.auth')
@section('title', trans('auth.signin.button'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_LIGHT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-signin-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ trans('auth.signin.title') }}</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<label class="form-label">{{ trans('auth.signin.username') }}</label>
						<input type="text" class="form-control" name="username" placeholder="{{ trans('auth.signin.username') }}">
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('global.password') }}
							<a href="{{ route('account-forgot-password') }}" class="float-right small" tabIndex="-1">{{ trans('auth.signin.forgot') }}</a>
						</label>
						<input type="password" class="form-control" name="password" placeholder="{{ trans('global.password') }}">
					</div>
					<div class="form-group">
						<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" name="rememberme" />
							<span class="custom-control-label">{{ trans('auth.signin.rememberme') }}</span>
						</label>
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ trans('auth.signin.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						<p><a href="{{ route('account-signup') }}">{{ trans('auth.signup.button') }}</a> &middot; <a href="{{ route('account-resendverification') }}">{{ trans('auth.signin.resend') }}</a></p>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop