@extends('layouts.auth')
@section('title', __('auth.signup.button'))
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_LIGHT') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-signup-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">{{ __('auth.signup.title') }}</div>
					@component('layouts.alert-session') @endcomponent
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="form-group row">
						<label class="form-label">{{ __('global.firstname') }}</label>
						<input type="text" class="form-control" name="firstname" placeholder="{{ __('global.firstname') }}" autocomplete="off" value="{{ old('firstname') }}">
						<label class="form-label">{{ __('global.lastname') }}</label>
						<input type="text" class="form-control"  name="lastname" placeholder="{{ __('global.lastname') }}" autocomplete="off" value="{{ old('lastname') }}">
						<label class="form-label">{{ __('global.username') }}</label>
						<input type="text" class="form-control"  name="username" placeholder="{{ __('global.username') }}" autocomplete="off" value="{{ old('username') }}">
						<label class="form-label">{{ __('global.birthdate') }}</label>
						<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="{{ __('auth.signup.dateofbirth') }} (YYYY-MM-DD)" autocomplete="off" value="{{ old('birthdate') }}" />
						<label class="form-label">{{ __('global.phone') }} <small class="float-right"><a data-toggle="tooltip" data-placement="top" title="{{ __('user.profile.edit.details.phonewhydesc') }}"><i class="fas fa-question-circle"></i> {{ __('user.profile.edit.details.phonewhy') }}</a></small></label>

						<input type="text" class="form-control" type="tel" id="phone" name="phone" placeholder="{{ __('global.phone') }}" autocomplete="off" value="{{ old('phone') }}" />
						<input type="hidden" name="phone_country" id="phone_country" value="{{ old('phone_country') }}">

						<label class="form-label">{{ __('global.email') }}</label>
						<input type="email" class="form-control" name="email" placeholder="{{ __('global.email') }}" autocomplete="off" value="{{ old('email') }}" onkeypress="changecase(event, this);">
						<label class="form-label">{{ __('global.password') }}</label>
						<input type="password" class="form-control" name="password" placeholder="{{ __('global.password') }}" autocomplete="off" style="border-bottom-left-radius:0;border-bottom-right-radius:0">
						<input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('global.confirm') }} {{ __('global.password') }}" autocomplete="off" style="border-top-left-radius:0;border-top-right-radius:0">
					</div>
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" class="custom-switch-input" name="tos-pp">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">{!! __('auth.signup.agreement') !!}</span>
						</label>
					</div>
					<div class="form-footer">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-primary btn-block">{{ __('auth.signup.button_alt') }}</button>
					</div>
					<hr>
					<div class="text-center text-muted mt-3">
						{{ __('auth.signup.haveaccount') }} <a href="{{ route('account-signin') }}">{{ __('auth.signin.button') }}</a>
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
		var countryinput = document.querySelector("#phone_country");
		var iti = window.intlTelInput(input, {
			preferredCountries: ["no"],
			initialCountry: "{{ $phone_country ?? 'auto' }}",
			geoIpLookup: function(success, failure) {
				$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
					var countryCode = (resp && resp.country) ? resp.country : "";
					success(countryCode);
				});
			},
		});
		countryinput.value = iti.getSelectedCountryData().iso2;
		// listen to the telephone input for changes
		input.addEventListener('countrychange', function(e) {
			countryinput.value = iti.getSelectedCountryData().iso2;
			console.log('countrychange: '+iti.getSelectedCountryData().iso2);
		});
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