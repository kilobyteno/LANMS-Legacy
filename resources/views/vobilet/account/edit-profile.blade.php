@extends('layouts.main')
@section('title', trans('user.profile.edit.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('user.profile.edit.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('user-profile', Sentinel::getUser()->username) }}">{{ trans('user.profile.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('user.profile.edit.title') }}</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('user-profile-edit-post', $username) }}">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('user.profile.myprofile') }}</h3>
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
					<h3 class="card-title">{{ trans('user.profile.edit.settings.title') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('showname')) has-error @endif">
						<label class="form-label">{{ trans('user.profile.edit.settings.show') }} {{ trans('user.profile.edit.settings.fullname') }}</label>
						<select class="form-control" name="showname">
							<option value="1" {{ ($showname == '1') ? 'selected' : '' }}>{{ trans('global.yes') }}</option>
							<option value="0" {{ ($showname == '0') ? 'selected' : '' }}>{{ trans('global.no') }}</option>
						</select>
						@if($errors->has('showemail'))
							<p class="text-danger">{{ $errors->first('showemail') }}</p>
						@endif
					</div>
					
					<div class="form-group @if ($errors->has('showemail')) has-error @endif">
						<label class="form-label">{{ trans('user.profile.edit.settings.show') }} {{ trans('global.email') }}</label>
						<select class="form-control" name="showemail">
							<option value="1" {{ ($showemail == '1') ? 'selected' : '' }}>{{ trans('global.yes') }}</option>
							<option value="0" {{ ($showemail == '0') ? 'selected' : '' }}>{{ trans('global.no') }}</option>
						</select>
						@if($errors->has('showemail'))
							<p class="text-danger">{{ $errors->first('showemail') }}</p>
						@endif
					</div>
					
					<div class="form-group @if ($errors->has('showonline')) has-error @endif">
						<label class="form-label">{{ trans('user.profile.edit.settings.show') }} {{ trans('user.profile.edit.settings.onlinestatus') }}</label>
						<select class="form-control" name="showonline">
							<option value="1" {{ ($showonline == '1') ? 'selected' : '' }}>{{ trans('global.yes') }}</option>
							<option value="0" {{ ($showonline == '0') ? 'selected' : '' }}>{{ trans('global.no') }}</option>
						</select>
						@if($errors->has('showonline'))
							<p class="text-danger">{{ $errors->first('showonline') }}</p>
						@endif
					</div>

					<div class="form-group @if ($errors->has('language')) has-error @endif">
						<label class="form-label">{{ trans('user.profile.edit.settings.language') }}</label>
						<select class="form-control" name="language">
							<option value="">-- {{ trans('global.pleaseselect') }} --</option>
							@foreach(array_flip(config('app.locales')) as $lang)
								<option value="{{ $lang }}" {{ ($language == $lang) ? 'selected' : '' }}>{{ trans('language.'.$lang) }}</option>
							@endforeach
						</select>
						@if($errors->has('language'))
							<p class="text-danger">{{ $errors->first('language') }}</p>
						@endif
					</div>

					<div class="form-group">
						<label class="form-label">{{ trans('user.profile.edit.settings.theme') }}</label>
						<select class="form-control" name="theme">
							<option value="">-- {{ trans('global.pleaseselect') }} --</option>
							@foreach(array_flip(config('app.themes')) as $lang)
								<option value="{{ $lang }}" {{ ($theme == $lang) ? 'selected' : '' }}>{{ trans('theme.'.$lang) }}</option>
							@endforeach
						</select>
						@if($errors->has('theme'))
							<p class="text-danger">{{ $errors->first('theme') }}</p>
						@endif
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('user.profile.edit.details.title') }}</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group @if($errors->has('firstname')) has-error @endif">
								<label class="form-label">{{ trans('global.firstname') }}</label>
								<div class="input-group">
									<input class="form-control" type="text" name="firstname" placeholder="John" value="{{ $firstname ?? old('firstname') }}">
								</div>
								@if($errors->has('firstname'))
									<p class="text-danger">{{ $errors->first('firstname') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('lastname')) has-error @endif">
								<label class="form-label">{{ trans('global.lastname') }}</label>
								<div class="input-group">
									<input class="form-control" type="text" name="lastname" placeholder="Doe" value="{{ $lastname ?? old('lastname') }}">
								</div>
								@if($errors->has('lastname'))
									<p class="text-danger">{{ $errors->first('lastname') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('birthdate')) has-error @endif">
								<label class="form-label">{{ trans('global.birthdate') }}</label>
								<input class="form-control" type="text" name="birthdate" id="birthdate" placeholder="1970-01-30" value="{{ $birthdate ?? old('birthdate') }}">
								@if($errors->has('birthdate'))
									<p class="text-danger">{{ $errors->first('birthdate') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('phone')) has-error @endif">
								<label class="form-label">{{ trans('global.phone') }} <small class="float-right"><a data-toggle="tooltip" data-placement="top" title="{{ trans('user.profile.edit.details.phonewhydesc') }}"><i class="fas fa-question-circle"></i> {{ trans('user.profile.edit.details.phonewhy') }}</a></small></label>
								<div class="input-group">
									<input class="form-control" type="tel" id="phone" name="phone" placeholder="+4722225555" value="{{ $phone ?? old('phone') }}">
								</div>
								@if($errors->has('phone'))
									<p class="text-danger">{{ $errors->first('phone') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('clothing_size')) has-error @endif">
								<label class="form-label">{{ trans('global.clothingsize.title') }}</label>
								<select class="form-control" name="clothing_size">
									<option value="0">{{ trans('global.clothingsize.nochoice') }}</option>
									<option value="1" {{ ($clothing_size === 1) ? 'selected' : '' }}>{{ trans('global.clothingsize.xs') }}</option>
									<option value="2" {{ ($clothing_size === 2) ? 'selected' : '' }}>{{ trans('global.clothingsize.s') }}</option>
									<option value="3" {{ ($clothing_size === 3) ? 'selected' : '' }}>{{ trans('global.clothingsize.m') }}</option>
									<option value="4" {{ ($clothing_size === 4) ? 'selected' : '' }}>{{ trans('global.clothingsize.l') }}</option>
									<option value="5" {{ ($clothing_size === 5) ? 'selected' : '' }}>{{ trans('global.clothingsize.xl') }}</option>
									<option value="6" {{ ($clothing_size === 6) ? 'selected' : '' }}>{{ trans('global.clothingsize.xxl') }}</option>
									<option value="7" {{ ($clothing_size === 7) ? 'selected' : '' }}>{{ trans('global.clothingsize.3xl') }}</option>
								</select>
								@if($errors->has('clothing_size'))
									<p class="text-danger">{{ $errors->first('clothing_size') }}</p>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @if ($errors->has('location')) has-error @endif">
								<label class="form-label">{{ trans('global.location') }}</label>
								<input class="form-control" type="text" name="location" placeholder="Oslo, Norway" value="{{ $location ?? old('location') }}">
								@if($errors->has('location'))
									<p class="text-danger">{{ $errors->first('location') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('occupation')) has-error @endif">
								<label class="form-label">{{ trans('global.occupation') }}</label>
								<input class="form-control" type="text" name="occupation" placeholder="IT Technician" value="{{ $occupation ?? old('occupation') }}">
								@if($errors->has('occupation'))
									<p class="text-danger">{{ $errors->first('occupation') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('gender')) has-error @endif">
								<label class="form-label">{{ trans('global.gender.title') }}</label>
								<select class="form-control" name="gender">
									<option value="">-- {{ trans('global.pleaseselect') }} --</option>
									<option value="Male" {{ ($gender == 'Male') ? 'selected' : '' }}>{{ trans('global.gender.male') }}</option>
									<option value="Female" {{ ($gender == 'Female') ? 'selected' : '' }}>{{ trans('global.gender.female') }}</option>
									<option value="Transgender" {{ ($gender == 'Transgender') ? 'selected' : '' }}>{{ trans('global.gender.transgender') }}</option>
									<option value="Genderless" {{ ($gender == 'Genderless') ? 'selected' : '' }}>{{ trans('global.gender.genderless') }}</option>
								</select>
								@if($errors->has('gender'))
									<p class="text-danger">{{ $errors->first('gender') }}</p>
								@endif
							</div>
							<div class="form-group @if($errors->has('about')) has-error @endif">
								<label class="form-label">{{ trans('global.about') }}</label>
								<textarea class="form-control" rows="3" name="about">{{ $about ?? old('about') }}</textarea>
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
					<h3 class="card-title">{{ trans('user.profile.edit.confirmpassword.title') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('password')) has-error @endif">
						<label class="form-label">{{ trans('global.password') }}</label>
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
					<button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> {{ trans('user.profile.edit.button') }}</button>
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
		window.intlTelInput(input, {
			preferredCountries: ["no"],
			initialCountry: "auto",
			geoIpLookup: function(success, failure) {
				$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
					var countryCode = (resp && resp.country) ? resp.country : "";
					success(countryCode);
				});
			},
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