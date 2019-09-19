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
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-role-update', $role->slug) }}" method="post">

					<div class="input-group mb-5">
						<div class="input-group-prepend">
							<div class="input-group-text">Name:</div>
						</div>
						<input type="text" class="form-control input-lg" name="name" autocomplete="off" placeholder="Editor" value="{{ (old('name')) ? old('name') : $role->name }}" />
						<span class="input-group-append">
							<button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
						</span>
						@if($errors->has('name'))
							<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif
					</div>

					<div class="input-group">
						@foreach($role->permissions as $k => $v)
							<label class="custom-control custom-checkbox mr-3 mb-2">
								<input type="checkbox" class="custom-control-input" type="checkbox" name="permission-{{ $k }}" {{ $v ? 'checked' : '' }} {{ $role->slug == 'superadmin' ? 'disabled' : '' }}>
								<span class="custom-control-label">{{ $k }}</span>
							</label>
						@endforeach
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>

	</div>
</div>

@stop
