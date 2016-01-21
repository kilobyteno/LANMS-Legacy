@extends('layouts.main')
@section('title', 'Create Page - Admin')
@section('css')
	<style>
		.ms-container .ms-list {
			width: 135px;
			height: 205px;
		}
		
		.post-save-changes {
			float: right;
		}
		
		@media screen and (max-width: 789px)
		{
			.post-save-changes {
				float: none;
				margin-bottom: 20px;
			}
		}
	</style>
	<link rel="stylesheet" href="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/bootstrap-datetimepicker.min.css') }}">
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Create Page</h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-pages') }}">Pages</a></li>
			<li class="active"><strong>Create Page</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-pages-store') }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Publish
						<i class="fa fa-check"></i>
					</button>
				</div>
				
				<div class="col-sm-10 @if($errors->has('title')) has-error @endif">
					<input type="text" class="form-control input-lg" name="title" placeholder="Article title" value="{{ (old('title')) ? old('title') : '' }}" />
				</div>
			</div>
			
			<br />

			<!-- WYSIWYG - Content Editor -->
			<div class="row">
				<div class="col-sm-12 @if($errors->has('content')) has-error @endif">
					<textarea class="form-control wysihtml5" rows="18" data-stylesheet-url="{{ Theme::url('css/wysihtml5-color.css ') }}" name="content">
						{{ (old('content')) ? old('content') : '' }}
					</textarea>
				</div>
			</div>
			
			<br />

			<!-- Metaboxes -->
			<div class="row">
				
				<!-- Metabox :: Publish Settings -->
				<div class="col-sm-4">
					
					<div class="panel panel-primary @if($errors->has('active')) panel-danger @endif" data-collapsed="0">
				
						<div class="panel-heading">
							<div class="panel-title">
								Publish Settings
							</div>
							
						</div>
						
						<div class="panel-body">
							
							<div class="checkbox checkbox-replace @if($errors->has('active')) text-danger @endif">
								<input type="checkbox" name="active">
								<label>Show on frontpage</label>
								<p><small><em>Will be visible on the users dashboard if checked or not</em></small></p>
							</div>
							
							<br />

							<div class="checkbox checkbox-replace @if($errors->has('showinmenu')) text-danger @endif">
								<input type="checkbox" name="showinmenu">
								<label>Show in Menu</label>
							</div>
									
						</div>
					
					</div>
					
				</div>
				
				<div class="col-sm-4">

					<div class="panel panel-primary @if($errors->has('slug')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Slug <small class="text-muted">*Optional</small></div>
						</div>
						<div class="panel-body">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-header"></i>
								</div>
								<input type="text" class="form-control" value="{{ (old('slug')) ? old('slug') : '' }}" name="slug">
							</div>
						</div>
					</div>
					
				</div>
				
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
</div>

@stop
@section('javascript')
	<script src="{{ Theme::url('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
	<script src="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.multi-select.js') }}"></script>
	<script src="{{ Theme::url('js/fileinput.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
	<script src="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-tagsinput.min.js') }}"></script>
@stop