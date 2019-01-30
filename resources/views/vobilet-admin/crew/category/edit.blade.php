@extends('layouts.main')
@section('title', 'Edit Category: '.$category->title.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Category: {{ $category->title }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew') }}">Crew</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew-category') }}">Categories</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Category #{{ $category->id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-crew-category-store') }}" method="post">

					<div class="row">

						<div class="col-sm-5 @if($errors->has('title')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										Title:
									</div>
								</div>
								<input type="text" class="form-control input-lg" name="title" placeholder="Category title" value="{{ (old('title')) ? old('title') : $category->title }}" />
							</div>
							@if($errors->has('title'))
								<p class="text-danger">{{ $errors->first('title') }}</p>
							@endif
						</div>

						<div class="col-sm-5 @if($errors->has('slug')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fa fa-heading"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" placeholder="Slug (Optional)" value="{{ (old('slug')) ? old('slug') : $category->slug }}" name="slug">
							</div>
							@if($errors->has('slug'))
								<p class="text-danger">{{ $errors->first('slug') }}</p>
							@endif
						</div>
						<div class="col-sm-2 post-save-changes">
							<button type="submit" class="btn btn-success btn-block btn-icon"><i class="fas fa-save mr-2"></i>Save</button>
						</div>
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>
	</div>
</div>

@stop