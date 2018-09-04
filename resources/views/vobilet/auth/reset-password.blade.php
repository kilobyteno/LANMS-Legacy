@extends('layouts.auth')
@section('title', 'Reset Password')
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_ALT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-reset-password-post', $resetpassword_code) }}">
				<div class="card-body p-6">
					<div class="card-title text-center">Reset Password</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<input type="text" class="form-control" value="{{ $resetpassword_code }}" readonly>
					</div>
					<div class="form-group">
						<label class="form-label">Confirm email or username</label>
						<input type="text" class="form-control" name="username"  placeholder="Confirm email or username">
					</div>
					<div class="form-group">
						<label class="form-label">New Password</label>
						<input type="password" class="form-control" name="password" placeholder="New Password">
					</div>
					<div class="form-group">
						<label class="form-label">Confirm New Password</label>
						<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">Reset</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						Forget it, <a href="{{ route('account-signup') }}">send me back</a> to the sign in page.
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop