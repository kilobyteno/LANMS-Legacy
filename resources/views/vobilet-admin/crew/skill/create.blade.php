@extends('layouts.main')
@section('title', 'Create Skill - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Skill</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew') }}">Crew</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew-skill') }}">Skill</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-crew-skill-store') }}" method="post">

					<div class="row">
						<div class="col-sm-5 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										Title:
									</div>
								</div>
								<input type="text" class="form-control input-lg" name="title" placeholder="Skill title" value="{{ (old('title')) ? old('title') : '' }}" />
							</div>
							@if($errors->has('title'))
								<p class="text-danger">{{ $errors->first('title') }}</p>
							@endif
						</div>

						<div class="col-sm-5 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fa fa-heading"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" placeholder="Slug (Optional)" value="{{ (old('slug')) ? old('slug') : '' }}" name="slug">
							</div>
							@if($errors->has('slug'))
								<p class="text-danger">{{ $errors->first('slug') }}</p>
							@endif
						</div>

						<div class="col-sm-2">
							<button type="submit" class="btn btn-success btn-block"><i class="fas fa-save mr-2"></i>Save</button>
						</div>

					</div>
					<div class="row">

						<div class="col-sm-5 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fab fa-font-awesome"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" placeholder="Icon" value="{{ (old('icon')) ? old('icon') : '' }}" name="icon">
							</div>
							<p>Icons can be found here: <a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io/icons</a></p>
							@if($errors->has('icon'))
								<p class="text-danger">{{ $errors->first('icon') }}</p>
							@endif
						</div>

						<div class="col-sm-5 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fab fa-fonticons"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" placeholder="Label" value="{{ (old('class')) ? old('class') : 'badge badge-primary' }}" name="class">
							</div>
							<p>Available labels can be found here: <a href="https://getbootstrap.com/docs/4.1/components/badge/" target="_blank">getbootstrap.com</a></p>
							@if($errors->has('class'))
								<p class="text-danger">{{ $errors->first('class') }}</p>
							@endif
						</div>

					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>

	</div>
</div>

@stop