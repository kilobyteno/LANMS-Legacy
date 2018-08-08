@extends('layouts.main')
@section('title', 'Edit User - '.$user->username.' - Admin')
@section('css')
	<style>
		.ms-container .ms-list {
			width: 135px;
			height: 205px;
		}
		
		.post-save-changes {
			float: right;
		}
		
		@media screen and (max-width: 789px)
		{
			.post-save-changes {
				float: none;
				margin-bottom: 20px;
			}
		}
	</style>
	<link rel="stylesheet" href="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/bootstrap-datetimepicker.min.css') }}">
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Edit User: <small>{{ $user->username }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-users') }}">Users</a></li>
			<li class="active"><strong>Edit User: {{ $user->username }}</strong></li>
		</ol>

		<form action="{{ route('admin-user-update', $user->id) }}" method="post" class="form-horizontal">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>

				<div class="col-sm-5">
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">User Details</div>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-3 control-label text-right">Status</label>
								<div class="col-sm-9">
									<p>
										@if(\Activation::completed($user))<div class="label label-primary">Activated</div>@endif
										@if($user->last_login)<div class="label label-info">Has logged in</div>@endif
										@if($user->deleted_at)<div class="label label-secondary">Deactivated</div>@endif
									</p>
								</div>
							</div>
							<hr>
							<div class="form-group @if($errors->has('firstname')) has-error @endif">
								<label for="firstname" class="col-sm-3 control-label text-right">Firstname</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="firstname" value="{{ (old('firstname')) ? old('firstname') : $user->firstname }}" />
									@if($errors->has('firstname'))
										<p class="text-danger">{{ $errors->first('firstname') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group @if($errors->has('lastname')) has-error @endif">
								<label for="lastname" class="col-sm-3 control-label text-right">Lastname</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="lastname" value="{{ (old('lastname')) ? old('lastname') : $user->lastname }}" />
									@if($errors->has('lastname'))
										<p class="text-danger">{{ $errors->first('lastname') }}</p>
									@endif
								</div>
							</div>
							<hr>
							<div class="form-group @if($errors->has('username')) has-error @endif">
								<label for="username" class="col-sm-3 control-label text-right">Username</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-user-secret"></span></span>
										<input type="text" class="form-control" name="username" value="{{ (old('username')) ? old('username') : $user->username }}" />
									</div>
									@if($errors->has('username'))
										<p class="text-danger">{{ $errors->first('username') }}</p>
									@endif
								</div>
							</div>
							<hr>
							<div class="form-group @if($errors->has('email')) has-error @endif">
								<label for="email" class="col-sm-3 control-label text-right">Email</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
										<input type="text" class="form-control" name="email" value="{{ (old('email')) ? old('email') : $user->email }}" />
									</div>
									@if($errors->has('email'))
										<p class="text-danger">{{ $errors->first('email') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-5">
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Personal Details</div>
						</div>
						<div class="panel-body">
							<div class="form-group @if($errors->has('gender')) has-error @endif">
								<label for="gender" class="col-sm-3 control-label text-right">Gender</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-{{ User::getGenderIcon($user->gender) }}"></span></span>
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
							</div>
							<div class="form-group @if($errors->has('location')) has-error @endif">
								<label for="location" class="col-sm-3 control-label text-right">Location</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-globe"></span></span>
										<input type="text" class="form-control" name="location" value="{{ (old('location')) ? old('location') : $user->location }}" />
									</div>
									@if($errors->has('location'))
										<p class="text-danger">{{ $errors->first('location') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group @if($errors->has('occupation')) has-error @endif">
								<label for="occupation" class="col-sm-3 control-label text-right">Occupation</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-briefcase"></span></span>
										<input type="text" class="form-control" name="occupation" value="{{ (old('occupation')) ? old('occupation') : $user->occupation }}" />
									</div>
									@if($errors->has('occupation'))
										<p class="text-danger">{{ $errors->first('occupation') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group @if($errors->has('birthdate')) has-error @endif">
								<label for="birthdate" class="col-sm-3 control-label text-right">Birthdate</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-birthday-cake"></span></span>
										<input type="text" class="form-control" name="birthdate" value="{{ (old('birthdate')) ? old('birthdate') : $user->birthdate }}" />
									</div>
									@if($errors->has('birthdate'))
										<p class="text-danger">{{ $errors->first('birthdate') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-sm-5">
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">User Settings</div>
						</div>
						<div class="panel-body">
							<div class="form-group @if($errors->has('showname')) has-error @endif">
								<label for="showname" class="col-sm-3 control-label text-right">Show Fullname</label>
								<div class="col-sm-9">
									<select class="form-control" name="showname">
										<option value="1" {{ ($user->showname == '1') ? 'selected' : '' }}>Yes</option>
										<option value="0" {{ ($user->showname == '0') ? 'selected' : '' }}>No</option>
									</select>
									@if($errors->has('showname'))
										<p class="text-danger">{{ $errors->first('showname') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group @if($errors->has('showemail')) has-error @endif">
								<label for="showemail" class="col-sm-3 control-label text-right">Show Email</label>
								<div class="col-sm-9">
									<select class="form-control" name="showemail">
										<option value="1" {{ ($user->showemail == '1') ? 'selected' : '' }}>Yes</option>
										<option value="0" {{ ($user->showemail == '0') ? 'selected' : '' }}>No</option>
									</select>
									@if($errors->has('showemail'))
										<p class="text-danger">{{ $errors->first('showemail') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group @if($errors->has('showonline')) has-error @endif">
								<label for="showonline" class="col-sm-3 control-label text-right">Show Online Status</label>
								<div class="col-sm-9">
									<select class="form-control" name="showonline">
										<option value="1" {{ ($user->showonline == '1') ? 'selected' : '' }}>Yes</option>
										<option value="0" {{ ($user->showonline == '0') ? 'selected' : '' }}>No</option>
									</select>
									@if($errors->has('showonline'))
										<p class="text-danger">{{ $errors->first('showonline') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Date and Time Settings</div>
						</div>
						<div class="panel-body">
							<div class="form-group @if($errors->has('userdateformat')) has-error @endif">
								<label for="userdateformat" class="col-sm-3 control-label text-right">Date Format</label>
								<div class="col-sm-9">
									<select class="form-control" name="userdateformat">
										<option value="d. M Y" {{ ($user->userdateformat == 'd. M Y') ? 'selected' : '' }}>{{ date('d. M Y', time()) }} (d. M Y)</option>
										<option value="d.m.y" {{ ($user->userdateformat == 'd.m.y') ? 'selected' : '' }}>{{ date('d.m.y', time()) }} (d.m.y)</option>
										<option value="F j, Y" {{ ($user->userdateformat == 'F j, Y') ? 'selected' : '' }}>{{ date('F j, Y', time()) }} (F j, Y)</option>
										<option value="M j, Y" {{ ($user->userdateformat == 'M j, Y') ? 'selected' : '' }}>{{ date('M j, Y', time()) }} (M j, Y)</option>
										<option value="n/j/y" {{ ($user->userdateformat == 'n/j/y') ? 'selected' : '' }}>{{ date('n/j/y', time()) }} (n/j/y)</option>
										<option value="Y/m/d" {{ ($user->userdateformat == 'Y/m/d') ? 'selected' : '' }}>{{ date('Y/m/d', time()) }} (Y/m/d)</option>
									</select>
									@if($errors->has('userdateformat'))
										<p class="text-danger">{{ $errors->first('userdateformat') }}</p>
									@endif
								</div>
							</div>
							<div class="form-group @if($errors->has('usertimeformat')) has-error @endif">
								<label for="usertimeformat" class="col-sm-3 control-label text-right">Time Format</label>
								<div class="col-sm-9">
									<select class="form-control" name="usertimeformat">
											<option value="H:i" {{ ($user->usertimeformat == 'H:i') ? 'selected' : '' }}>{{ date('H:i', time()) }} (H:i)</option>
											<option value="g:i a" {{ ($user->usertimeformat == 'g:i a') ? 'selected' : '' }}>{{ date('g:i a', time()) }} (g:i a)</option>
										</select>
									@if($errors->has('usertimeformat'))
										<p class="text-danger">{{ $errors->first('usertimeformat') }}</p>
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
@section('javascript')
	<script src="{{ Theme::url('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
	<script src="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.multi-select.js') }}"></script>
	<script src="{{ Theme::url('js/fileinput.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
	<script src="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-tagsinput.min.js') }}"></script>
@stop