@extends('layouts.main')
@section('title', 'Edit Role - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Role</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-roles') }}">Roles</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Role</li>
	</ol>
</div>

<div class="row">
	<div class="col-8">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-role-update', $role->slug) }}" method="post">

					<div class="input-group mb-5">
						<div class="input-group-prepend">
							<div class="input-group-text">Name:</div>
						</div>
						<input type="text" class="form-control input-lg" name="name" autocomplete="off" placeholder="Editor" value="{{ (old('name')) ? old('name') : $role->name }}" {{ $role->slug == 'default' ? 'disabled' : '' }} />
						<span class="input-group-append">
							<button class="btn btn-success" type="submit" {{ $role->slug == 'default' ? 'disabled' : '' }}><i class="fa fa-save mr-2"></i> Save</button>
						</span>
						@if($errors->has('name'))
							<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif
					</div>

					<div class="input-group">
						@foreach($role->permissions as $k => $v)
							<label class="custom-control custom-checkbox mr-3 mb-2">
								<input type="checkbox" class="custom-control-input" type="checkbox" name="permission-{{ $k }}" {{ $v ? 'checked' : '' }} {{ $role->slug == 'superadmin' || $role->slug == 'default' ? 'disabled' : '' }}>
								<span class="custom-control-label">{{ $k }}</span>
							</label>
						@endforeach
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>

	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Members</h3>
			</div>
			<div class="card-body o-auto" style="min-height: 30em">
				<ul class="list-unstyled list-separated">
					@foreach($role->users as $member)
						<li class="list-separated-item">
							<div class="row align-items-center">
								<div class="col-auto">
									<span class="avatar brround avatar-md d-block" style="background-image: url({{ $member->profilepicture ?? '/images/profilepicture/0.png' }})"></span>
								</div>
								<div class="col">
									<div>
										<a href="{{ route('admin-user-edit', $member->id) }}" class="text-inherit">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
									</div>
									<small class="d-block item-except text-sm text-muted h-1x">{{ $member->username }}</small>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@stop
