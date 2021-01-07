@extends('layouts.main')
@section('title', __('user.profile.edit.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('user.profile.edit.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('user-profile', Sentinel::getUser()->username) }}">{{ __('user.profile.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('user.profile.edit.title') }}</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('user-profile-edit-post', $username) }}">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.myprofile') }}</h3>
				</div>
				<div class="card-body">
					<div class="row mb-2">
						<div class="col-auto">
							<span class="avatar brround avatar-xl" style="background-image: url({{ $profilepicturesmall ?? '/images/profilepicture/0_small.png' }})"></span>
						</div>
						<div class="col">
							<h3 class="mb-1">{{ $firstname }} {{ $lastname }}</h3>
							<p class="mb-4">{{ $username }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.edit.settings.title') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('showname')) has-error @endif">
						<label class="form-label">{{ __('user.profile.edit.settings.show') }} {{ __('user.profile.edit.settings.fullname') }}</label>
						<select class="form-control" name="showname">
							<option value="1" {{ ($showname == '1') ? 'selected' : '' }}>{{ __('global.yes') }}</option>
							<option value="0" {{ ($showname == '0') ? 'selected' : '' }}>{{ __('global.no') }}</option>
						</select>
						@if($errors->has('showemail'))
							<p class="text-danger">{{ $errors->first('showemail') }}</p>
						@endif
					</div>
					
					<div class="form-group @if ($errors->has('showemail')) has-error @endif">
						<label class="form-label">{{ __('user.profile.edit.settings.show') }} {{ __('global.email') }}</label>
						<select class="form-control" name="showemail">
							<option value="1" {{ ($showemail == '1') ? 'selected' : '' }}>{{ __('global.yes') }}</option>
							<option value="0" {{ ($showemail == '0') ? 'selected' : '' }}>{{ __('global.no') }}</option>
						</select>
						@if($errors->has('showemail'))
							<p class="text-danger">{{ $errors->first('showemail') }}</p>
						@endif
					</div>
					
					<div class="form-group @if ($errors->has('showonline')) has-error @endif">
						<label class="form-label">{{ __('user.profile.edit.settings.show') }} {{ __('user.profile.edit.settings.onlinestatus') }}</label>
						<select class="form-control" name="showonline">
							<option value="1" {{ ($showonline == '1') ? 'selected' : '' }}>{{ __('global.yes') }}</option>
							<option value="0" {{ ($showonline == '0') ? 'selected' : '' }}>{{ __('global.no') }}</option>
						</select>
						@if($errors->has('showonline'))
							<p class="text-danger">{{ $errors->first('showonline') }}</p>
						@endif
					</div>

					<div class="form-group @if ($errors->has('language')) has-error @endif">
						<label class="form-label">{{ __('user.profile.edit.settings.language') }}</label>
						<select class="form-control" name="language">
							<option value="">-- {{ __('global.pleaseselect') }} --</option>
							@foreach(array_flip(config('app.locales')) as $lang)
								<option value="{{ $lang }}" {{ ($language == $lang) ? 'selected' : '' }}>{{ __('language.'.$lang) }}</option>
							@endforeach
						</select>
						@if($errors->has('language'))
							<p class="text-danger">{{ $errors->first('language') }}</p>
						@endif
					</div>

					<div class="form-group">
						<label class="form-label">{{ __('user.profile.edit.settings.theme') }}</label>
						<select class="form-control" name="theme">
							<option value="">-- {{ __('global.pleaseselect') }} --</option>
							@foreach(array_flip(config('app.themes')) as $lang)
								<option value="{{ $lang }}" {{ ($theme == $lang) ? 'selected' : '' }}>{{ __('theme.'.$lang) }}</option>
							@endforeach
						</select>
						@if($errors->has('theme'))
							<p class="text-danger">{{ $errors->first('theme') }}</p>
						@endif
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.edit.settings.2fa.title') }}</h3>
					@if(env('AUTHY_SECRET'))
						<div class="card-options">@if(!$authy_id) <span class="badge badge-danger">{{ ucfirst(__('global.deactivated')) }}</a> @else <span class="badge badge-success">{{ ucfirst(__('global.activated')) }}</span> @endif</div>
					@endif
				</div>
				<div class="card-body">
					@if(env('AUTHY_SECRET'))
						<div class="form-group">
							@if($phone_verified_at)
								<div class="alert alert-info mb-3"><i class="fas fa-info-circle"></i> {!! __('user.profile.edit.settings.2fa.info', ['url' => 'https://authy.com/download/']) !!}</div>
								@if(!$authy_id)
									<a class="btn btn-success text-white" href="{{ route('account-2fa-activate') }}"><i class="fas fa-check-double"></i> {{ __('global.activate') }}</a>
								@elseif($authy_id)
									<a class="btn btn-danger text-white" href="{{ route('account-2fa-deactivate') }}"><i class="far fa-times-circle"></i> {{ __('global.deactivate') }}</a>
								@endif
							@else
								<div class="alert alert-warning mb-3"><i class="fas fa-exclamation-triangle"></i> {{ __('user.profile.edit.settings.2fa.disabled') }}</div>
								<button class="btn btn-success text-white" disabled="disabled"><i class="fas fa-check-double"></i> {{ __('global.activate') }}</button>
							@endif
						</div>
					@else
						<div class="alert alert-info m-0"><i class="fas fa-info-circle"></i> {{ __('user.profile.edit.settings.2fa.alert.missingenv') }}</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.edit.details.title') }}</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group @if($errors->has('username')) has-error @endif">
								<label class="form-label">{{ __('global.username') }}</label>
								<div class="input-group">
									<input class="form-control" type="text" name="username" placeholder="johnman" value="{{ $username ?? old('username') }}">
								</div>
								@if($errors->has('firstname'))
									<p class="text-danger">{{ $errors->first('firstname') }}</p>
								@endif
							</div>
							<div class="form-group @if($errors->has('firstname')) has-error @endif">
								<label class="form-label">{{ __('global.firstname') }}</label>
								<div class="input-group">
									<input class="form-control" type="text" name="firstname" placeholder="John" value="{{ $firstname ?? old('firstname') }}">
								</div>
								@if($errors->has('firstname'))
									<p class="text-danger">{{ $errors->first('firstname') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('lastname')) has-error @endif">
								<label class="form-label">{{ __('global.lastname') }}</label>
								<div class="input-group">
									<input class="form-control" type="text" name="lastname" placeholder="Doe" value="{{ $lastname ?? old('lastname') }}">
								</div>
								@if($errors->has('lastname'))
									<p class="text-danger">{{ $errors->first('lastname') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('birthdate')) has-error @endif">
								<label class="form-label">{{ __('global.birthdate') }}</label>
								<input class="form-control" type="text" name="birthdate" id="birthdate" placeholder="1970-01-30" value="{{ $birthdate ?? old('birthdate') }}">
								@if($errors->has('birthdate'))
									<p class="text-danger">{{ $errors->first('birthdate') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('phone')) has-error @endif">
								<label class="form-label">{{ __('global.phone') }} @if(env('AUTHY_SECRET'))@if(!$phone_verified_at) <a class="badge badge-danger" href="{{ route('account-verifyphone') }}">{{ ucfirst(__('global.notverified')) }}</a> @else &middot; <span class="text-success">{{ ucfirst(__('global.verified')) }}</span> @endif @endif <small class="float-right"><a data-toggle="tooltip" data-placement="top" title="{{ __('user.profile.edit.details.phonewhydesc') }}"><i class="fas fa-question-circle"></i> {{ __('user.profile.edit.details.phonewhy') }}</a></small></label>
								<div class="input-group">
									<input class="form-control" type="tel" id="phone" name="phone" placeholder="22225555" value="{{ $phone ?? old('phone') }}">
									<input type="hidden" name="phone_country" id="phone_country" value="{{ $phone_country ?? old('phone_country') }}">
								</div>
								@if($errors->has('phone'))
									<p class="text-danger">{{ $errors->first('phone') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('clothing_size')) has-error @endif">
								<label class="form-label">{{ __('global.clothingsize.title') }}</label>
								<select class="form-control" name="clothing_size">
									<option value="0">{{ __('global.clothingsize.nochoice') }}</option>
									<option value="1" {{ ($clothing_size === 1) ? 'selected' : '' }}>{{ __('global.clothingsize.xs') }}</option>
									<option value="2" {{ ($clothing_size === 2) ? 'selected' : '' }}>{{ __('global.clothingsize.s') }}</option>
									<option value="3" {{ ($clothing_size === 3) ? 'selected' : '' }}>{{ __('global.clothingsize.m') }}</option>
									<option value="4" {{ ($clothing_size === 4) ? 'selected' : '' }}>{{ __('global.clothingsize.l') }}</option>
									<option value="5" {{ ($clothing_size === 5) ? 'selected' : '' }}>{{ __('global.clothingsize.xl') }}</option>
									<option value="6" {{ ($clothing_size === 6) ? 'selected' : '' }}>{{ __('global.clothingsize.xxl') }}</option>
									<option value="7" {{ ($clothing_size === 7) ? 'selected' : '' }}>{{ __('global.clothingsize.3xl') }}</option>
								</select>
								@if($errors->has('clothing_size'))
									<p class="text-danger">{{ $errors->first('clothing_size') }}</p>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @if ($errors->has('location')) has-error @endif">
								<label class="form-label">{{ __('global.location') }}</label>
								<input class="form-control" type="text" name="location" placeholder="Oslo, Norway" value="{{ $location ?? old('location') }}">
								@if($errors->has('location'))
									<p class="text-danger">{{ $errors->first('location') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('occupation')) has-error @endif">
								<label class="form-label">{{ __('global.occupation') }}</label>
								<input class="form-control" type="text" name="occupation" placeholder="IT Technician" value="{{ $occupation ?? old('occupation') }}">
								@if($errors->has('occupation'))
									<p class="text-danger">{{ $errors->first('occupation') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('gender')) has-error @endif">
								<label class="form-label">{{ __('global.gender.title') }}</label>
								<select class="form-control" name="gender">
									<option value="">-- {{ __('global.pleaseselect') }} --</option>
									<option value="Male" {{ ($gender == 'Male') ? 'selected' : '' }}>{{ __('global.gender.male') }}</option>
									<option value="Female" {{ ($gender == 'Female') ? 'selected' : '' }}>{{ __('global.gender.female') }}</option>
									<option value="Transgender" {{ ($gender == 'Transgender') ? 'selected' : '' }}>{{ __('global.gender.transgender') }}</option>
									<option value="Genderless" {{ ($gender == 'Genderless') ? 'selected' : '' }}>{{ __('global.gender.genderless') }}</option>
								</select>
								@if($errors->has('gender'))
									<p class="text-danger">{{ $errors->first('gender') }}</p>
								@endif
							</div>
							<div class="form-group @if($errors->has('about')) has-error @endif">
								<label class="form-label">{{ __('global.about') }}</label>
								<textarea class="form-control" rows="4" name="about">{{ $about ?? old('about') }}</textarea>
								@if($errors->has('about'))
									<p class="text-danger">{{ $errors->first('about') }}</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.edit.address.title') }}</h3>
				</div>
				<div class="card-body">
					
					<div class="form-group @if($errors->has('address_street')) has-error @endif">
						<label class="form-label">{{ __('global.address.street') }}</label>
						<input class="form-control" type="text" name="address_street" placeholder="Jernbanegata 15" value="{{ $address_street ?? old('address_street') }}">
						@if($errors->has('address_street'))
							<p class="text-danger">{{ $errors->first('address_street') }}</p>
						@endif
					</div>

					<div class="row">
						<div class="col-md-6 form-group @if($errors->has('address_postalcode')) has-error @endif">
							<label class="form-label">{{ __('global.address.postalcode') }}</label>
							<input class="form-control" type="text" name="address_postalcode" placeholder="2609" value="{{ $address_postalcode ?? old('address_postalcode') }}">
							@if($errors->has('address_postalcode'))
								<p class="text-danger">{{ $errors->first('address_postalcode') }}</p>
							@endif
						</div>

						<div class="col-md-6 form-group @if($errors->has('address_city')) has-error @endif">
							<label class="form-label">{{ __('global.address.city') }}</label>
							<input class="form-control" type="text" name="address_city" placeholder="Lillehammer" value="{{ $address_city ?? old('address_city') }}">
							@if($errors->has('address_city'))
								<p class="text-danger">{{ $errors->first('address_city') }}</p>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group @if($errors->has('address_county')) has-error @endif">
							<label class="form-label">{{ __('global.address.county') }}</label>
							<input class="form-control" type="text" name="address_county" placeholder="Oppland" value="{{ $address_county ?? old('address_county') }}">
							@if($errors->has('address_county'))
								<p class="text-danger">{{ $errors->first('address_county') }}</p>
							@endif
						</div>

						<div class="col-md-6 form-group @if($errors->has('address_country')) has-error @endif">
							<label class="form-label">{{ __('global.address.country') }}</label>
							<input class="form-control" type="text" name="address_country" placeholder="Norway" value="{{ $address_country ?? old('address_country') }}">
							@if($errors->has('address_country'))
								<p class="text-danger">{{ $errors->first('address_country') }}</p>
							@endif
						</div>
					</div>

				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.edit.confirmpassword.title') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('password')) has-error @endif">
						<label class="form-label">{{ __('global.password') }}</label>
						<div class="input-group">
							<input class="form-control" type="password" name="password">
						</div>
						@if($errors->has('password'))
							<p class="text-danger">{{ $errors->first('password') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> {{ __('user.profile.edit.button') }}</button>
				</div>
			</div>
			
		</div>
	</form>
</div>
@stop

@section('css')
	<link href="{{ Theme::url('css/intlTelInput.css') }}" rel="stylesheet" />
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
	<script src="{{ Theme::url('js/cleave.js') }}"></script>
	<script type="text/javascript">
		var cleave = new Cleave('#birthdate', {
		    date: true,
		    datePattern: ['Y', 'm', 'd'],
		    delimiter: '-'
		});
	</script>
@stop