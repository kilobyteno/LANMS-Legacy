@extends('layouts.main')
@section('title', 'Edit Category - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Category: {{ $category->name }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-news') }}">News</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-news-category') }}">Category</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit: #{{ $category->id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-news-category-store') }}" method="post">
					<div class="row">
						<div class="col-sm-5 @if($errors->has('name')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										Name
									</div>
								</div>
								<input type="text" class="form-control input-lg" name="name" placeholder="Name" value="{{ (old('name')) ? old('name') : $category->name }}" />
							</div>
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
						<div class="col-sm-5 @if($errors->has('slug')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										.../news/category/
									</div>
								</div>
								<input type="text" class="form-control input-lg" placeholder="Slug (Optional)" value="{{ (old('slug')) ? old('slug') : $category->slug }}" name="slug">
							</div>
							@if($errors->has('slug'))
								<p class="text-danger">{{ $errors->first('slug') }}</p>
							@endif
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-green btn-block"><i class="fas fa-save mr-2"></i> Save</button>
						</div>
					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</div>
		</div>
	</div>
</div>

@stop