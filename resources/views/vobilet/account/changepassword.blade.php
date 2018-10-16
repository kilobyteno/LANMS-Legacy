@extends('layouts.main')
@section('title', 'Change Password')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Change Password</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item">Account</li>
			<li class="breadcrumb-item active" aria-current="page">Change Password</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('account-change-password-post') }}">
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
							<h3 class="mb-1">{{ Sentinel::getUser()->firstname }} {{ Sentinel::getUser()->lastname }}</h3>
							<p class="mb-4">{{ Sentinel::getUser()->username }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Edit your password</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('current_password')) has-error @endif">
						<label class="form-label">Current Password</label>
						<div class="input-group">
							<input class="form-control" type="password" name="current_password">
						</div>
						@if($errors->has('current_password'))
							<p class="text-danger">{{ $errors->first('current_password') }}</p>
						@endif
					</div>
					<div class="form-group @if ($errors->has('password')) has-error @endif">
						<label class="form-label">New Password</label>
						<div class="input-group">
							<input class="form-control" type="password" name="password">
						</div>
						@if($errors->has('password'))
							<p class="text-danger">{{ $errors->first('password') }}</p>
						@endif
					</div>
					<div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
						<label class="form-label">Confirm New Password</label>
						<div class="input-group">
							<input class="form-control" type="password" name="password_confirmation">
						</div>
						@if($errors->has('password_confirmation'))
							<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-key"></i> Update Password</button>
				</div>
			</div>
			
		</div>
	</form>
</div>
@stop