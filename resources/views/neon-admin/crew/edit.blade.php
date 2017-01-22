@extends('layouts.main')
@section('title', 'Edit Crew - '.$crew->title.' - Admin')
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

		<h1 class="margin-bottom">Edit Crew: <small>#{{ $crew->id }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-crew') }}">Crew</a></li>
			<li class="active"><strong>Edit Crew #{{ $crew->id }}</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-crew-update', $crew->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>
				
				<div class="col-sm-5 @if($errors->has('username')) has-error @endif">
					<input type="text" class="form-control input-lg" name="username" placeholder="Crew title" value="{{ $crew->user->username.' ('.User::getFullnameByID($crew->user->id).')' }}" />
					<input type="text" class="hidden" id="username_id" name="username_id" value="{{ $crew->user->id }}">
					@if($errors->has('username'))
						<p class="text-danger">{{ $errors->first('username') }}</p>
					@endif
				</div>

				<div class="col-sm-5 @if($errors->has('slug')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-header"></i>
						</div>
						<input type="text" class="form-control input-lg" placeholder="Slug (Optional)" value="{{ (old('slug')) ? old('slug') : $crew->slug }}" name="slug">
					</div>
					@if($errors->has('slug'))
						<p class="text-danger">{{ $errors->first('slug') }}</p>
					@endif
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
</div>

@stop
@section('javascript')
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$('#username').typeahead({
					onSelect: function(item) {
						document.getElementById("username_id").value = item.value;
						console.log("username_id: " + item.value);
					},
					ajax: {
						url: "/ajax/usernames",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
				$('#crewcategory').typeahead({
					onSelect: function(item) {
						document.getElementById("crewcategory_id").value = item.value;
						console.log("crewcategory_id: " + item.value);
					},
					ajax: {
						url: "/ajax/crew/categories",
						timeout: 500,
						displayField: "title",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
	
	<script src="{{ Theme::url('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
	<script src="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.multi-select.js') }}"></script>
	<script src="{{ Theme::url('js/fileinput.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
	<script src="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-tagsinput.min.js') }}"></script>
@stop