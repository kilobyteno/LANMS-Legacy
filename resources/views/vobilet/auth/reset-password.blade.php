@extends('layouts.auth')
@section('title', trans('auth.reset.title'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-reset-password-post', $resetpassword_code) }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ trans('auth.reset.title') }}</div>
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
						<label class="form-label">{{ trans('auth.reset.username') }}</label>
						<input type="text" class="form-control" name="username"  placeholder="{{ trans('auth.reset.username') }}" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('auth.reset.password') }}</label>
						<input type="password" class="form-control" name="password" placeholder="{{ trans('auth.reset.password') }}" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('auth.reset.passwordagain') }}</label>
						<input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('auth.reset.passwordagain') }}" autocomplete="off">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ trans('auth.reset.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{!! trans('auth.reset.forgetit', ['url' => route('account-signin')]) !!}
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop