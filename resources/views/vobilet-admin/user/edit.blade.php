@extends('layouts.main')
@section('title', 'Edit User: '.$user->username.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit User: {{ $user->username }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-users') }}">Users</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit User: {{ $user->username }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		

		<form action="{{ route('admin-user-update', $user->id) }}" method="post" class="card">
			<div class="card-header">
				<h3 class="card-title">
					@if(\Activation::completed($user))<div class="badge badge-primary">Activated</div>@endif
					@if($user->last_login)<div class="badge badge-info">Has logged in</div>@endif
					@if($user->deleted_at)<div class="badge badge-secondary">Deactivated</div>@endif
				</h3>
				<div class="card-options">
					<button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Save</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-4">
						<div class="expanel expanel-default" data-collapsed="0">
							<div class="expanel-heading">
								<div class="expanel-title">User Details</div>
							</div>
							<div class="expanel-body">
								<div class="form-group @if($errors->has('firstname')) has-error @endif">
									<label for="firstname" class="form-label">Firstname</label>
									<input type="text" class="form-control" name="firstname" autocomplete="off" value="{{ (old('firstname')) ? old('firstname') : $user->firstname }}" />
									@if($errors->has('firstname'))
										<p class="text-danger">{{ $errors->first('firstname') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('lastname')) has-error @endif">
									<label for="lastname" class="form-label">Lastname</label>
									<input type="text" class="form-control" name="lastname" autocomplete="off" value="{{ (old('lastname')) ? old('lastname') : $user->lastname }}" />
									@if($errors->has('lastname'))
										<p class="text-danger">{{ $errors->first('lastname') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('username')) has-error @endif">
									<label for="username" class="form-label">Username</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="far fa-user"></i>
											</div>
										</div>
										<input type="text" class="form-control" name="username" autocomplete="off" value="{{ (old('username')) ? old('username') : $user->username }}" />
									</div>
									@if($errors->has('username'))
										<p class="text-danger">{{ $errors->first('username') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('email')) has-error @endif">
									<label for="email" class="form-label">Email</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-envelope"></i>
											</div>
										</div>
										<input type="text" class="form-control" name="email" autocomplete="off" value="{{ (old('email')) ? old('email') : $user->email }}" />
									</div>
									@if($errors->has('email'))
										<p class="text-danger">{{ $errors->first('email') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="expanel expanel-default" data-collapsed="0">
							<div class="expanel-heading">
								<div class="expanel-title">Personal Details</div>
							</div>
							<div class="expanel-body">
								<div class="form-group @if($errors->has('gender')) has-error @endif">
									<label for="gender" class="form-label">Gender</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-{{ User::getGenderIcon($user->gender) }}"></i>
											</div>
										</div>
										<select class="form-control" name="gender">
											<option value="">-- Please select --</option>
											<option value="Male" {{ ($user->gender == 'Male') ? 'selected' : '' }}>Male</option>
											<option value="Female" {{ ($user->gender == 'Female') ? 'selected' : '' }}>Female</option>
											<option value="Transgender" {{ ($user->gender == 'Transgender') ? 'selected' : '' }}>Transgender</option>
											<option value="Genderless" {{ ($user->gender == 'Genderless') ? 'selected' : '' }}>Genderless</option>
										</select>
									</div>
									@if($errors->has('gender'))
										<p class="text-danger">{{ $errors->first('gender') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('location')) has-error @endif">
									<label for="location" class="form-label">Location</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-map-marker"></i>
											</div>
										</div>
										<input type="text" class="form-control" name="location" autocomplete="off" value="{{ (old('location')) ? old('location') : $user->location }}" />
									</div>
									@if($errors->has('location'))
										<p class="text-danger">{{ $errors->first('location') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('occupation')) has-error @endif">
									<label for="occupation" class="form-label">Occupation</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-briefcase"></i>
											</div>
										</div>
										<input type="text" class="form-control" name="occupation" autocomplete="off" value="{{ (old('occupation')) ? old('occupation') : $user->occupation }}" />
									</div>
									@if($errors->has('occupation'))
										<p class="text-danger">{{ $errors->first('occupation') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('birthdate')) has-error @endif">
									<label for="birthdate" class="form-label">Birthdate</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-birthday-cake"></i>
											</div>
										</div>
										<input type="text" class="form-control" id="birthdate" name="birthdate" autocomplete="off" value="{{ (old('birthdate')) ? old('birthdate') : $user->birthdate }}" />
									</div>
									@if($errors->has('birthdate'))
										<p class="text-danger">{{ $errors->first('birthdate') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('phone')) has-error @endif">
									<label for="phone" class="form-label">Phone</label>
									<input type="tel" class="form-control" id="phone" name="phone" autocomplete="off" value="{{ (old('phone')) ? old('phone') : $user->phone }}" />
									@if($errors->has('phone'))
										<p class="text-danger">{{ $errors->first('phone') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="expanel expanel-default" data-collapsed="0">
							<div class="expanel-heading">
								<div class="expanel-title">User Settings</div>
							</div>
							<div class="expanel-body">
								<div class="form-group @if($errors->has('showname')) has-error @endif">
									<label for="showname" class="form-label">Show Fullname</label>
									<select class="form-control" name="showname">
										<option value="1" {{ ($user->showname == '1') ? 'selected' : '' }}>Yes</option>
										<option value="0" {{ ($user->showname == '0') ? 'selected' : '' }}>No</option>
									</select>
									@if($errors->has('showname'))
										<p class="text-danger">{{ $errors->first('showname') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('showemail')) has-error @endif">
									<label for="showemail" class="form-label">Show Email</label>
									<select class="form-control" name="showemail">
										<option value="1" {{ ($user->showemail == '1') ? 'selected' : '' }}>Yes</option>
										<option value="0" {{ ($user->showemail == '0') ? 'selected' : '' }}>No</option>
									</select>
									@if($errors->has('showemail'))
										<p class="text-danger">{{ $errors->first('showemail') }}</p>
									@endif
								</div>
								<div class="form-group @if($errors->has('showonline')) has-error @endif">
									<label for="showonline" class="form-label">Show Online Status</label>
									<select class="form-control" name="showonline">
										<option value="1" {{ ($user->showonline == '1') ? 'selected' : '' }}>Yes</option>
										<option value="0" {{ ($user->showonline == '0') ? 'selected' : '' }}>No</option>
									</select>
									@if($errors->has('showonline'))
										<p class="text-danger">{{ $errors->first('showonline') }}</p>
									@endif
								</div>
								<div class="form-group @if ($errors->has('language')) has-error @endif">
									<label class="form-label">Language</label>
									<select class="form-control" name="language">
										<option value="">-- Please Select --</option>
										@foreach(array_flip(config('app.locales')) as $lang)
											<option value="{{ $lang }}" {{ ($user->language == $lang) ? 'selected' : '' }}>{{ trans('language.'.$lang) }}</option>
										@endforeach
									</select>
									@if($errors->has('language'))
										<p class="text-danger">{{ $errors->first('language') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
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