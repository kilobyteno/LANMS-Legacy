@extends('layouts.main')
@section('title', 'Edit Setting - '.$key.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Setting: {{ $key }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-settings') }}">Settings</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Setting: {{ $key }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">

		<div class="alert alert-danger" role="alert"> <strong><i class="fa fa-exclamation-triangle"></i> IMPORTANT!</strong> You need to know what you are doing. If you do not know what you are doing you will cause errors on the website. Please be carefull! Ask support if you need help.</div>
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-settings-update', $key) }}" method="post">

					<div class="input-group">
						<input type="text" class="form-control input-lg" name="value" placeholder="Setting Value" value="{{ (old('value')) ? old('value') : $value }}" />
						<span class="input-group-append">
							<button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
						</span>
						@if($errors->has('value'))
							<p class="text-danger">{{ $errors->first('value') }}</p>
						@endif
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>

	</div>
</div>

@stop