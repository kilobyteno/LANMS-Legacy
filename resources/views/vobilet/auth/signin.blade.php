@extends('layouts.auth')
@section('title', 'Sign In')
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_ALT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" method="post">
				<div class="card-body p-6">
					<div class="card-title text-center">Login to your Account</div>
					<div class="form-group">
						<label class="form-label">Email or username</label>
						<input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Email or username">
					</div>
					<div class="form-group">
						<label class="form-label">Password
							<a href="{{ route('account-forgot-password') }}" class="float-right small">I forgot my password</a>
						</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
					<div class="form-group">
						<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" />
							<span class="custom-control-label">Remember me</span>
						</label>
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">Sign in</button>
					</div>
					<div class="text-center text-muted mt-3">
						Don't have account yet? <a href="{{ route('account-signup') }}">Sign up</a>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop