@extends('layouts.auth')
@section('title', __('auth.forgot.title'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				@if(Setting::get('WEB_LOGO_DARK') || Setting::get('WEB_LOGO_LIGHT'))
					<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_LIGHT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
				@else
					<h1 class="text-white">{{ Setting::get('WEB_NAME') ?? config('app.name', 'LANMS') }}</h1>
				@endif
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-forgot-password-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ __('auth.forgot.title') }}</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<label class="form-label">{{ __('auth.forgot.username') }}</label>
						<input type="text" class="form-control" name="username"  placeholder="{{ __('auth.forgot.username') }}" autocomplete="off">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ __('auth.forgot.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{!! __('auth.forgot.forgetit', ['url' => route('account-signin')]) !!}
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop