@extends('layouts.main')
@section('title', 'Edit Profile')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Profile</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item">Profile</li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('user-profile-edit-post', $username) }}">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">My Profile</h3>
				</div>
				<div class="card-body">
					<div class="row mb-2">
						<div class="col-auto">
							<span class="avatar brround avatar-xl" style="background-image: url({{ $profilepicturesmall or '/images/profilepicture/0_small.png' }})"></span>
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
					<h3 class="card-title">Edit your settings</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('showname')) has-error @endif">
						<label class="form-label">Show Fullname</label>
						<select class="form-control" name="showname">
							<option value="1" {{ ($showname == '1') ? 'selected' : '' }}>Yes</option>
							<option value="0" {{ ($showname == '0') ? 'selected' : '' }}>No</option>
						</select>
						@if($errors->has('showemail'))
							<p class="text-danger">{{ $errors->first('showemail') }}</p>
						@endif
					</div>
					
					<div class="form-group @if ($errors->has('showemail')) has-error @endif">
						<label class="form-label">Show Email</label>
						<select class="form-control" name="showemail">
							<option value="1" {{ ($showemail == '1') ? 'selected' : '' }}>Yes</option>
							<option value="0" {{ ($showemail == '0') ? 'selected' : '' }}>No</option>
						</select>
						@if($errors->has('showemail'))
							<p class="text-danger">{{ $errors->first('showemail') }}</p>
						@endif
					</div>
					
					<div class="form-group @if ($errors->has('showonline')) has-error @endif">
						<label class="form-label">Show Online Status</label>
						<select class="form-control" name="showonline">
							<option value="1" {{ ($showonline == '1') ? 'selected' : '' }}>Yes</option>
							<option value="0" {{ ($showonline == '0') ? 'selected' : '' }}>No</option>
						</select>
						@if($errors->has('showonline'))
							<p class="text-danger">{{ $errors->first('showonline') }}</p>
						@endif
					</div>

					<div class="form-group @if ($errors->has('userdateformat')) has-error @endif">
						<label class="form-label">Date format</label>
						<select class="form-control" name="userdateformat">
							<option value="d. M Y" {{ ($userdateformat == 'd. M Y') ? 'selected' : '' }}>{{ date('d. M Y', time()) }} (d. M Y)</option>
							<option value="d.m.y" {{ ($userdateformat == 'd.m.y') ? 'selected' : '' }}>{{ date('d.m.y', time()) }} (d.m.y)</option>
							<option value="F j, Y" {{ ($userdateformat == 'F j, Y') ? 'selected' : '' }}>{{ date('F j, Y', time()) }} (F j, Y)</option>
							<option value="M j, Y" {{ ($userdateformat == 'M j, Y') ? 'selected' : '' }}>{{ date('M j, Y', time()) }} (M j, Y)</option>
							<option value="n/j/y" {{ ($userdateformat == 'n/j/y') ? 'selected' : '' }}>{{ date('n/j/y', time()) }} (n/j/y)</option>
							<option value="Y/m/d" {{ ($userdateformat == 'Y/m/d') ? 'selected' : '' }}>{{ date('Y/m/d', time()) }} (Y/m/d)</option>
						</select>
						@if($errors->has('userdateformat'))
							<p class="text-danger">{{ $errors->first('userdateformat') }}</p>
						@endif
					</div>

					<div class="form-group @if ($errors->has('usertimeformat')) has-error @endif">
						<label class="form-label">Time format</label>
						<select class="form-control" name="usertimeformat">
							<option value="H:i" {{ ($usertimeformat == 'H:i') ? 'selected' : '' }}>{{ date('H:i', time()) }} (H:i)</option>
							<option value="g:i a" {{ ($usertimeformat == 'g:i a') ? 'selected' : '' }}>{{ date('g:i a', time()) }} (g:i a)</option>
						</select>
						@if($errors->has('usertimeformat'))
							<p class="text-danger">{{ $errors->first('usertimeformat') }}</p>
						@endif
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Edit your profile</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group @if($errors->has('firstname')) has-error @endif">
								<label class="form-label">Firstname</label>
								<div class="input-group">
									<input class="form-control" type="text" name="firstname" placeholder="John" value="{{ $firstname }}">
								</div>
								@if($errors->has('firstname'))
									<p class="text-danger">{{ $errors->first('firstname') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('birthdate')) has-error @endif">
								<label class="form-label">Birthdate</label>
								<input class="form-control" type="text" name="birthdate" placeholder="1970-01-30" value="{{ $birthdate }}">
								@if($errors->has('birthdate'))
									<p class="text-danger">{{ $errors->first('birthdate') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('location')) has-error @endif">
								<label class="form-label">Location</label>
								<input class="form-control" type="text" name="location" placeholder="Oslo, Norway" value="{{ $location }}">
								@if($errors->has('location'))
									<p class="text-danger">{{ $errors->first('location') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('occupation')) has-error @endif">
								<label class="form-label">Occupation</label>
								<input class="form-control" type="text" name="occupation" placeholder="IT Technician" value="{{ $occupation }}">
								@if($errors->has('occupation'))
									<p class="text-danger">{{ $errors->first('occupation') }}</p>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @if ($errors->has('lastname')) has-error @endif">
								<label class="form-label">Lastname</label>
								<div class="input-group">
									<input class="form-control" type="text" name="lastname" placeholder="Doe" value="{{ $lastname }}">
								</div>
								@if($errors->has('lastname'))
									<p class="text-danger">{{ $errors->first('lastname') }}</p>
								@endif
							</div>
							<div class="form-group @if ($errors->has('gender')) has-error @endif">
								<label class="form-label">Gender</label>
								<select class="form-control" name="gender">
									<option value="">-- Please select --</option>
									<option value="Male" {{ ($gender == 'Male') ? 'selected' : '' }}>Male</option>
									<option value="Female" {{ ($gender == 'Female') ? 'selected' : '' }}>Female</option>
									<option value="Transgender" {{ ($gender == 'Transgender') ? 'selected' : '' }}>Transgender</option>
									<option value="Genderless" {{ ($gender == 'Genderless') ? 'selected' : '' }}>Genderless</option>
								</select>
								@if($errors->has('gender'))
									<p class="text-danger">{{ $errors->first('gender') }}</p>
								@endif
							</div>
							<div class="form-group @if($errors->has('about')) has-error @endif">
								<label class="form-label">About</label>
								<textarea class="form-control" rows="4" name="about">{{ $about }}</textarea>
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
					<h3 class="card-title">Confirm changes with your password</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('password')) has-error @endif">
						<label class="form-label">Password</label>
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
					<button type="submit" class="btn btn-success">Update Profile</button>
				</div>
			</div>
			
		</div>
	</form>
</div>
@stop