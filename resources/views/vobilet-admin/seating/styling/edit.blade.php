@extends('layouts.main')
@section('title', 'Edit Styling - '.$id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Styling: {{ $id }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-styling') }}">Styling</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Styling: {{ $id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">
		
		<form class="card" action="{{ route('admin-seating-styling-update', $id) }}" method="post">
			<div class="card-header">
				<div class="card-title">{{ $id }}</div>
				<div class="card-options">
					<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
				</div>
			</div>
			<div class="card-body">
				<textarea type="text" class="form-control input-lg" name="content" rows="20">{{ (old('content')) ? old('content') : $content }}</textarea>
				@if($errors->has('content'))
					<p class="text-danger">{{ $errors->first('content') }}</p>
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
		</form>

	</div>
</div>

@stop