@extends('layouts.main')
@section('title', 'Create Page - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Page</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-pages') }}">Pages</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Page</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-pages-store') }}" method="post">

					<div class="input-group mb-5">
						<input type="text" class="form-control input-lg" name="title" autocomplete="off" placeholder="Title" value="{{ (old('title')) ? old('title') : '' }}" />
						<span class="input-group-append">
							<button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
						</span>
						@if($errors->has('title'))
							<p class="text-danger">{{ $errors->first('title') }}</p>
						@endif
					</div>

					<!-- WYSIWYG - Content Editor -->
					<div class="row">
						<div class="col-sm-12 @if($errors->has('content')) has-error @endif">
							<textarea class="content richText-initial" name="content">
								{{ (old('content')) ? old('content') : '' }}
							</textarea>
							@if($errors->has('content'))
								<p class="text-danger">{{ $errors->first('content') }}</p>
							@endif
						</div>
					</div>
					
					<br />

					<!-- Metaboxes -->
					<div class="row">
						
						<div class="col-sm-4">
							<div class="expanel expanel-default @if($errors->has('active')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Page Settings</div>
								</div>
								<div class="expanel-body">
									<div class="@if($errors->has('active')) text-danger @endif">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="active" checked="">
											<span class="custom-control-label">Active</span>
										</label>
										<p><small><em>If unchecked the page won't be visible or accessible anywhere</em></small></p>
										@if($errors->has('active'))
											<p class="text-danger">{{ $errors->first('active') }}</p>
										@endif
									</div>
									<div class="@if($errors->has('showinmenu')) text-danger @endif">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="showinmenu" checked="">
											<span class="custom-control-label">Show in Menu</span>
										</label>
										<p><small><em>If checked the page will be visible in the menu on the frontend</em></small></p>
										@if($errors->has('showinmenu'))
											<p class="text-danger">{{ $errors->first('showinmenu') }}</p>
										@endif
									</div>	
								</div>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="expanel expanel-default @if($errors->has('slug')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Slug <small class="text-muted">*Optional</small></div>
								</div>
								<div class="expanel-body">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fa fa-heading"></i>
											</div>
										</div>
										<input type="text" class="form-control" value="{{ (old('slug')) ? old('slug') : '' }}" name="slug" autocomplete="off">
									</div>
									<br>
									<p><em>Example: info</em></p>
									@if($errors->has('slug'))
										<p class="text-danger">{{ $errors->first('slug') }}</p>
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
	<script src="{{ Theme::url('plugins/wysiwyag/jquery.richtext.js') }}"></script>
	<script type="text/javascript">
		$(function(e) {
			$('.content').richText();
			$('.richText-help').remove(); // Remove useless help icon
		});
	</script>
@stop