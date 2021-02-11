@extends('layouts.main')
@section('title', 'Edit Ticket Type #'.$tickettype->id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Ticket Type</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-tickettypes') }}">Ticket Types</a></li>
		<li class="breadcrumb-item">#{{ $tickettype->id }}</li>
		<li class="breadcrumb-item active" aria-current="page">Edit</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<form class="card" action="{{ route('admin-seating-tickettype-update', $tickettype->id) }}" method="post" enctype="multipart/form-data">
			<div class="card-body">

				<div class="row">

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" class="form-control input-lg" name="name" placeholder="Premium" value="{{ (old('name')) ? old('name') : $tickettype->name }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group">
							<label class="form-control-label">Price</label>
							<input type="text" class="form-control input-lg" name="price" placeholder="100" value="{{ (old('price')) ? old('price') : $tickettype->price }}" />
							@if($errors->has('price'))
								<p class="text-danger">{{ $errors->first('price') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group">
							<label class="form-control-label">Color <small class="text-muted">in hex format without #</small></label>
							<input type="text" class="form-control input-lg" name="color" placeholder="4bcffa" value="{{ (old('color')) ? old('color') : $tickettype->color }}" />
							@if($errors->has('color'))
								<p class="text-danger">{{ $errors->first('color') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Image <small class="text-muted">115x115</small></label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="image">
								<label class="custom-file-label">{{ __('global.choosefile') }}</label>
							</div>
							@if($errors->has('image'))
								<p class="text-danger">{{ $errors->first('image') }}</p>
							@endif
						</div>
					</div>

					<div class="col-sm-2">
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
						<textarea name="description" class="form-control">{{ (old('description')) ? old('description') : $tickettype->description }}</textarea>
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
	<div class="col-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Current Image</h4>
			</div>
			<div class="card-body">
				<img src="{{ $type->image ?? Theme::url('images/profilepicture/0.png') }}" class="img-fluid">
			</div>
		</div>
	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		$('.custom-file-input').on('change', function() { 
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName); 
		});
	</script>
@stop