@extends('layouts.auth')
@section('title', 'Sign In')
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_ALT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-signin-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">Sign in to your Account</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<label class="form-label">Email or username</label>
						<input type="text" class="form-control" name="username" placeholder="Email or username">
					</div>
					<div class="form-group">
						<label class="form-label">Password
							<a href="{{ route('account-forgot-password') }}" class="float-right small" tabIndex="-1">I forgot my password</a>
						</label>
						<input type="password" class="form-control" name="password" placeholder="Password">
					</div>
					<div class="form-group">
						<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" name="rememberme" />
							<span class="custom-control-label">Remember me</span>
						</label>
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">Sign in</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						<p><a href="{{ route('account-signup') }}">Sign Up</a> &middot; <a href="{{ route('account-resendverification') }}">Resend activation email</a></p>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop