@extends('layouts.auth')
@section('title', trans('auth.signup.button'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-signup-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ trans('auth.signup.title') }}</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group row">
						<label class="form-label">{{ trans('global.firstname') }}</label>
						<input type="text" class="form-control" name="firstname" placeholder="{{ trans('global.firstname') }}" autocomplete="off" value="{{ old('firstname') }}">
						<label class="form-label">{{ trans('global.lastname') }}</label>
						<input type="text" class="form-control"  name="lastname" placeholder="{{ trans('global.lastname') }}" autocomplete="off" value="{{ old('lastname') }}">
						<label class="form-label">{{ trans('global.username') }}</label>
						<input type="text" class="form-control"  name="username" placeholder="{{ trans('global.username') }}" autocomplete="off" value="{{ old('username') }}">
						<label class="form-label">{{ trans('global.birthdate') }}</label>
						<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="{{ trans('auth.signup.dateofbirth') }} (YYYY-MM-DD)" autocomplete="off" value="{{ old('birthdate') }}" />
						<label class="form-label">{{ trans('global.phone') }} <small class="float-right"><a data-toggle="tooltip" data-placement="top" title="{{ trans('user.profile.edit.details.phonewhydesc') }}"><i class="fas fa-question-circle"></i> {{ trans('user.profile.edit.details.phonewhy') }}</a></small></label>
						<input type="text" class="form-control" type="tel" id="phone" name="phone" placeholder="{{ trans('global.phone') }}" autocomplete="off" value="{{ old('phone') }}" />
						<label class="form-label">{{ trans('global.email') }}</label>
						<input type="email" class="form-control" name="email" placeholder="{{ trans('global.email') }}" autocomplete="off" value="{{ old('email') }}" onkeypress="changecase(event, this);">
						<label class="form-label">{{ trans('global.password') }}</label>
						<input type="password" class="form-control" name="password" placeholder="{{ trans('global.password') }}" autocomplete="off" style="border-bottom-left-radius:0;border-bottom-right-radius:0">
						<input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('global.confirm') }} {{ trans('global.password') }}" autocomplete="off" style="border-top-left-radius:0;border-top-right-radius:0">
					</div>
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" class="custom-switch-input" name="tos-pp">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">{!! trans('auth.signup.agreement') !!}</span>
						</label>
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ trans('auth.signup.button_alt') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{{ trans('auth.signup.haveaccount') }} <a href="{{ route('account-signin') }}">{{ trans('auth.signin.button') }}</a>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop

@section('css')
	<link href="{{ Theme::url('css/intlTelInput.css') }}" rel="stylesheet" />
	<style type="text/css">
		.form-label {
			margin-top: .375rem;
			margin-bottom: 0;
		}
	</style>
@stop

@section('javascript')
	<script src="{{ Theme::url('js/vendors/intlTelInput.min.js') }}"></script>
	<script>
		var input = document.querySelector("#phone");
		window.intlTelInput(input);
	</script>

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
		    datePattern: ['Y', 'm', 'd'],
		    delimiter: '-'
		});
	</script>
@stop