@extends('layouts.main')
@section('title', 'Create Ticket Type - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Ticket Type</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-tickettypes') }}">Ticket Types</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<form class="card" action="{{ route('admin-seating-tickettype-store') }}" method="post">
			<div class="card-body">

				<div class="row">

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" class="form-control input-lg" name="name" placeholder="Premium" value="{{ (old('name')) ? old('name') : '' }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Price</label>
							<input type="text" class="form-control input-lg" name="price" placeholder="100" value="{{ (old('price')) ? old('price') : '' }}" />
							@if($errors->has('price'))
								<p class="text-danger">{{ $errors->first('price') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Color <small class="text-muted">in hex format without #</small></label>
							<input type="text" class="form-control input-lg" name="color" placeholder="4bcffa" value="{{ (old('color')) ? old('color') : '' }}" />
							@if($errors->has('color'))
								<p class="text-danger">{{ $errors->first('color') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Active <small class="text-muted">Shown on tickets page</small></label>
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="active" checked="">
								<span class="custom-control-label">Yes</span>
							</label>
							@if($errors->has('active'))
								<p class="text-danger">{{ $errors->first('active') }}</p>
							@endif
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-12">
						<label class="form-control-label">Description <small class="text-muted">HTML is allowed</small></label>
						<textarea name="description" class="form-control">{{ (old('description')) ? old('description') : '' }}</textarea>
						@if($errors->has('description'))
							<p class="text-danger">{{ $errors->first('description') }}</p>
						@endif
					</div>
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Save</button>
			</div>
		</form>
	</div>
</div>

@stop