@extends('layouts.auth')
@section('title', __('auth.activate.title'))
   
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
			<form class="card" role="form" method="post" action="{{ route('account-activate-post', $activation_code) }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ __('auth.activate.title') }}</div>
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
						<label class="form-label">{{ __('auth.activate.username') }}</label>
						<input type="text" class="form-control" name="username" placeholder="Confirm email or username" autocomplete="off">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-success btn-block">{{ __('auth.activate.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{!! __('auth.activate.forgetit', ['url' => route('account-signin')]) !!}
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop