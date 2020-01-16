@extends('layouts.main')
@section('title', 'Edit Sponsor - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Sponsor</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-sponsor') }}">Sponsor</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Sponsor</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-sponsor-update', $sponsor->id) }}" method="post" enctype="multipart/form-data">

					<div class="input-group mb-5">
						<div class="input-group-prepend">
							<div class="input-group-text">Name:</div>
						</div>
						<input type="text" class="form-control input-lg" name="name" autocomplete="off" placeholder="Alphabet Inc." value="{{ (old('name')) ? old('name') : $sponsor->name }}" />
						<span class="input-group-append">
							<button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
						</span>
						@if($errors->has('name'))
							<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif
					</div>

					<div class="row">
						
						
						<div class="col-sm-6">
							<div class="expanel expanel-default @if($errors->has('description') || $errors->has('url') || $errors->has('sort_order')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Information</div>
								</div>
								<div class="expanel-body">
									<div class="form-group">
										<label class="form-label">URL <small>*Optional</small></label>
										<input type="text" class="form-control input-lg" name="url" placeholder="https://abc.xyz (*Optional)" value="{{ (old('url')) ? old('url') : $sponsor->url }}" />
										@if($errors->has('url'))
											<p class="text-danger">{{ $errors->first('url') }}</p>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Description <small>*Optional</small></label>
										<textarea class="form-control input-lg" name="description" placeholder="Alphabet is providing network services for the whole event.">{{ (old('description')) ? old('description') : $sponsor->description }}</textarea>
										@if($errors->has('description'))
											<p class="text-danger">{{ $errors->first('description') }}</p>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Sort Order</label>
										<input type="number" class="form-control input-lg" name="sort_order" min="0" max="999" value="{{ (old('sort_order')) ? old('sort_order') : $sponsor->sort_order }}">
										@if($errors->has('sort_order'))
											<p class="text-danger">{{ $errors->first('sort_order') }}</p>
										@endif
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="expanel expanel-default @if($errors->has('image_light')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Light Logo (335x90)</div>
								</div>
								<div class="expanel-body">
									<label class="text-muted">This logo should be of lighter colors and work on dark background.</label>
									<div style="max-width: 335px; height: 90px;">
										<img src="{{ $sponsor->image_light }}" alt="{{ $sponsor->name }}">
									</div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="image_light" accept="image/*">
										<label class="custom-file-label">{{ trans('global.choosefile') }}</label>
									</div>
									@if($errors->has('image_light'))
										<p class="text-danger">{{ $errors->first('image_light') }}</p>
									@endif
								</div>
							</div>

							<div class="expanel expanel-default @if($errors->has('image_dark')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Dark Logo (335x90)</div>
								</div>
								<div class="expanel-body">
									<label class="text-muted">This logo should be of darker colors and work on light background.</label>
									<div style="max-width: 335px; height: 90px;">
										<img src="{{ $sponsor->image_dark }}" alt="{{ $sponsor->name }}">
									</div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="image_dark" accept="image/*">
										<label class="custom-file-label">{{ trans('global.choosefile') }}</label>
									</div>
									@if($errors->has('image_dark'))
										<p class="text-danger">{{ $errors->first('image_dark') }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
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