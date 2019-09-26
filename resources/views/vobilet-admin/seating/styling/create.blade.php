@extends('layouts.main')
@section('title', 'Create Styling - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Styling</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-styling') }}">Styling</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Styling</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">
		
		<form class="card" action="{{ route('admin-seating-styling-store') }}" method="post">
			<div class="card-header">
				<div class="card-title">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								Filename:
							</div>
						</div>
						<input type="text" class="form-control" placeholder="another-css-file" name="title" value="{{ (old('title')) ? old('title') : '' }}">
						<div class="input-group-append">
							<div class="input-group-text">
								.css
							</div>
						</div>
					</div>
				</div>
				<div class="card-options">
					<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
				</div>
			</div>
			<div class="card-body">
				<textarea type="text" class="form-control input-lg" name="content" rows="20">{{ (old('content')) ? old('content') : '' }}</textarea>
				@if($errors->has('content'))
					<p class="text-danger">{{ $errors->first('content') }}</p>
				@endif
				@if($errors->has('title'))
					<p class="text-danger">{{ $errors->first('title') }}</p>
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
		</form>

	</div>
</div>

@stop