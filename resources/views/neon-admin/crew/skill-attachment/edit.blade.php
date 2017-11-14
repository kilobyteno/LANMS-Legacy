@extends('layouts.main')
@section('title', 'Edit Skill Attachment - '.$skilla->title.' - Admin')
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

		<h1 class="margin-bottom">Edit Skill: <small>{{ $skilla->name }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-crew') }}">Crew</a></li>
			<li><a href="{{ route('admin-crew-skill-attachment') }}">Skill Attachment</a></li>
			<li class="active"><strong>Edit Skill #{{ $skilla->id }}</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-crew-skill-attachment-update', $skilla->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>
				
				<div class="col-sm-5">
					<input type="text" class="form-control input-lg disabled" disabled="" value="{{ $skilla->user->username.' ('.User::getFullnameByID($skilla->user->id).')' }}" />
				</div>

				<div class="col-sm-5 @if($errors->has('skill_id')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-briefcase"></i>
						</div>
						<input type="text" class="form-control input-lg" name="skill" id="skill" placeholder="Crew Skill" value="{{ $skilla->skill->title }}" autocomplete="OFF">
						<input type="text" class="hidden" id="skill_id" name="skill_id" value="{{ $skilla->skill->id }}">
					</div>
					@if($errors->has('skill_id'))
						<p class="text-danger">{{ $errors->first('skill_id') }}</p>
					@endif
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

	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#skill').typeahead({
					onSelect: function(item) {
						document.getElementById("skill_id").value = item.value;
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/crew/skills",
						timeout: 500,
						displayField: "title",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop