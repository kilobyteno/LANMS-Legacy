@extends('layouts.auth')
@section('title', trans('auth.resend.title'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-resendverification-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ trans('auth.resend.title') }}</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<label class="form-label">{{ trans('auth.resend.email') }}</label>
						<input type="text" class="form-control" name="email"  placeholder="{{ trans('auth.resend.email') }}">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ trans('auth.resend.button') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{!! trans('auth.resend.forgetit', ['url' => route('account-signin')]) !!}
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop