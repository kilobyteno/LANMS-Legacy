@extends('layouts.main')
@section('title', 'Check-in - Admin')
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

		<h1 class="margin-bottom">Check-in</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Print</strong></li>
		</ol>

		<br />
		
		<form action="{{ route('admin-print-seat') }}" method="post">

			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Show PDF
						<i class="fa fa-print"></i>
					</button>
				</div>
				
				<div class="col-sm-10 @if($errors->has('seat_id')) has-error @endif">
					<input type="text" class="form-control input-lg" name="seat_name" id="seat_name" placeholder="Seat Name" value="{{ (old('seat_name')) ? old('seat_name') : '' }}" autocomplete="off" />
					@if($errors->has('seat_id'))
						<p class="text-danger">{{ $errors->first('seat_id') }}</p>
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
			$(document).ready( function() { 
				$('#seat_name').typeahead({
					onSelect: function(item) {
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/seats",
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