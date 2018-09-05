@extends('layouts.auth')
@section('title', 'Resend Verification')
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_ALT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-resendverification-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">Resend Verification</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<label class="form-label">Email</label>
						<input type="text" class="form-control" name="email"  placeholder="Email">
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">Send</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						Forget it, <a href="{{ route('account-signin') }}">send me back</a> to the sign in page.
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop