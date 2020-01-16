@extends('layouts.main')
@section('title', 'Edit Info - '.$info->name.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Info:  {{ $info->name }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-info') }}">Info</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Info:  {{ $info->name }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">

		<div class="card">
			<div class="card-body">
				<p class="text-muted">{{ $info->description ?? '' }}</p>
				<form action="{{ route('admin-info-update', $info->id) }}" method="post">
					<div class="input-group">
						<input type="text" class="form-control input-lg" name="content" placeholder="Info Value" value="{{ (old('content')) ? old('content') : $info->content }}" />
						<span class="input-group-append">
							<button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
						</span>
						@if($errors->has('content'))
							<p class="text-danger">{{ $errors->first('content') }}</p>
						@endif
					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</div>
		</div>
		
	</div>
</div>

@stop