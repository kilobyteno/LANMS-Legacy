@extends('layouts.main')
@section('title', 'Create Article - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Article</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-news') }}">News</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Article</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-news-store') }}" method="post">

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

					<div class="row">
					
						<div class="col-sm-4">
							
							<div class="expanel expanel-default @if($errors->has('active')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Publish Settings</div>
								</div>
								<div class="expanel-body">
									
									<div class="form-group @if($errors->has('active')) text-danger @endif">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="active" checked="">
											<span class="custom-control-label">Show on frontpage</span>
										</label>
										<p><small><em>Will be visible on the users dashboard if checked or not</em></small></p>
										@if($errors->has('active'))
											<p class="text-danger">{{ $errors->first('active') }}</p>
										@endif
									</div>
									<div class="form-group @if($errors->has('active')) text-danger @endif">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="socialmedia">
											<span class="custom-control-label">Publish to Social Media</span>
											<p><small><em>If social media is setup by an admin it will post</em></small></p>
										</label>
									</div>
									<div class="row">
										<div class="col-md-6">
											<p>Publish Date</p>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar"></i>
													</div>
												</div>
												<input class="form-control datepicker" name="published_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('published_at_date')) ? old('published_at_date') : Carbon::now()->isoFormat('YYYY-MM-DD') }}">
												@if($errors->has('published_at_date'))
													<p class="text-danger">{{ $errors->first('published_at_date') }}</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<p>Publish Time</p>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-clock"></i>
													</div>
												</div>
												<input class="form-control ui-timepicker-input @if($errors->has('published_at_time')) is-invalid state-invalid @endif" id="published_at_time" placeholder="Set time" type="text" autocomplete="off" name="published_at_time" value="{{ (old('published_at_time')) ? old('published_at_time') : Carbon::now()->isoFormat('HH:mm') }}">
												@if($errors->has('published_at_time'))
													<p class="text-danger">{{ $errors->first('published_at_time') }}</p>
												@endif
											</div>
										</div>
									</div>
											
								</div>
							
							</div>
							
						</div>
						
						<div class="col-sm-4">
							
							<div class="expanel expanel-default @if($errors->has('category_id')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Category</div>
								</div>
								<div class="expanel-body">
									<select name="category_id" class="select2">
										@foreach($categories as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
									@if($errors->has('category_id'))
										<p class="text-danger">{{ $errors->first('category_id') }}</p>
									@endif
								</div>
							</div>

							<div class="expanel expanel-default @if($errors->has('slug')) expanel-danger @endif" data-collapsed="0">
								<div class="expanel-heading">
									<div class="expanel-title">Slug <small class="text-muted">*Optional</small></div>
								</div>
								<div class="expanel-body">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												.../news/
											</div>
										</div>
										<input type="text" class="form-control" value="{{ (old('slug')) ? old('slug') : '' }}" name="slug">
									</div>
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
@section('css')
	<link href="{{ Theme::url('plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('js/vendors/bootstrap-datepicker3.standalone.css') }} rel="stylesheet">
	<link href="{{ Theme::url('plugins/wysiwyag/richtext.min.css') }}" rel="stylesheet">
@stop
@section('javascript')

	<script src="{{ Theme::url('js/vendors/bootstrap-datepicker.js') }}"></script>

	<!-- Time -->
	<script src="{{ Theme::url('plugins/time-picker/jquery.timepicker.js') }}"></script>

	<!-- maskedinput -->
	<script src="{{ Theme::url('plugins/input-mask/jquery.maskedinput.js') }}"></script>

	<!-- Activations -->
	<script type="text/javascript">
		$(function(){
		    $('#published_at_time').timepicker({
		    	'scrollDefault': 'now',
		    	'timeFormat': 'H:i',
		    	'step': 10
		    });
		    $('.select2').select2();
		    $('.datepicker').datepicker({
		    	format: 'yyyy-mm-dd',
		    	todayBtn: "linked",
			    calendarWeeks: true,
			    autoclose: true,
			    todayHighlight: true
		    });
		});
	</script>

	<script src="{{ Theme::url('plugins/wysiwyag/jquery.richtext.js') }}"></script>
	<script type="text/javascript">
		$(function(e) {
			$('.content').richText();
			$('.richText-help').remove(); // Remove useless help icon
		});
	</script>
@stop