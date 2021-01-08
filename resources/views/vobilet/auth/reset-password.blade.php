@extends('layouts.auth')
@section('title', __('auth.reset.title'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_LIGHT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-reset-password-post', $resetpassword_code) }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ __('auth.reset.title') }}</div>
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
						<label class="form-label">{{ __('auth.reset.username') }}</label>
						<input type="text" class="form-control" name="username"  placeholder="{{ __('auth.reset.username') }}" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('auth.reset.password') }}</label>
						<input type="password" class="form-control" name="password" placeholder="{{ __('auth.reset.password') }}" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('auth.reset.passwordagain') }}</label>
						<input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('auth.reset.passwordagain') }}" autocomplete="off">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ __('auth.reset.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{!! __('auth.reset.forgetit', ['url' => route('account-signin')]) !!}
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop