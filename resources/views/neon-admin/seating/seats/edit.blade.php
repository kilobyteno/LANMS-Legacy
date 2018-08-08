@extends('layouts.main')
@section('title', 'Edit Seat - #'.$seat->id.' - Admin')
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
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Edit Seat: <small>#{{ $seat->id }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li><a href="{{ route('admin-seating-seats') }}">Seats</a></li>
			<li class="active"><strong>Edit Seat #{{ $seat->id }}</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-seating-seat-update', $seat->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-save"></i>
					</button>
				</div>

				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('name')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Name</div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" name="name" placeholder="A1" value="{{ $seat->name }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>
				</div>

				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('row_id')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Row</div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" id="row" placeholder="A" value="{{ $seat->row->name or '' }}" autocomplete="off" />
							<input type="text" class="hidden" id="row_id" name="row_id" value="{{ $seat->row->id or '0' }}">
							@if($errors->has('row_id'))
								<p class="text-danger">{{ $errors->first('row_id') }}</p>
							@endif
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
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#row').typeahead({
					onSelect: function(item) {
						document.getElementById("row_id").value = item.value;
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/rows",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop