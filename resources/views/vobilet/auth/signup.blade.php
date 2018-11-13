@extends('layouts.auth')
@section('title', 'Sign Up')
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-signup-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">Create New Account</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group">
						<label class="form-label">Firstname</label>
						<input type="text" class="form-control" name="firstname" placeholder="Firstname" autocomplete="off" value="{{ old('firstname') }}">
					</div>
					<div class="form-group">
						<label class="form-label">Lastname</label>
						<input type="text" class="form-control"  name="lastname" placeholder="Lastname" autocomplete="off" value="{{ old('lastname') }}">
					</div>
					<div class="form-group">
						<label class="form-label">Username</label>
						<input type="text" class="form-control"  name="username" placeholder="Username" autocomplete="off" value="{{ old('username') }}">
					</div>
					<div class="form-group">
						<label class="form-label">Birthdate</label>
						<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Date of Birth (DD/MM/YYYY)" autocomplete="off" value="{{ old('birthdate') }}" />
					</div>
					<div class="form-group">
						<label class="form-label">Email address</label>
						<input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}" onkeypress="changecase(event, this);">
					</div>
					<div class="form-group">
						<label class="form-label">Password</label>
						<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" style="border-bottom-left-radius:0;border-bottom-right-radius:0">
						<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="off" style="border-top-left-radius:0;border-top-right-radius:0">
					</div>
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" class="custom-switch-input" name="tos-pp">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">I have read and agree to the<br><strong>Terms of Service and Privacy Policy</strong></span>
						</label>
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">Create new account</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						Already have account? <a href="{{ route('account-signin') }}">Sign in</a>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		function changecase(e, obj)  {
			var key = e.which || window.event.keyCode;
			if ((key >= 65) && (key <= 90))  {
				obj.value+=String.fromCharCode(key).toLowerCase(); 
				if (e.preventDefault)
					e.preventDefault();	
				e.returnValue = false; 	
			}
		} 
	</script>
	<script src="{{ Theme::url('js/cleave.js') }}"></script>
	<script type="text/javascript">
		var cleave = new Cleave('#birthdate', {
		    date: true,
		    datePattern: ['d', 'm', 'Y']
		});
	</script>
@stop