@extends('layouts.main')
@section('title', 'Reserve Seat: '.$currentseat->name.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Reserve Seat</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Reserve Seat: {{ $currentseat->name }}</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				@section('css')
					<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
				@stop
				@include('seating.seatmap')
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<form class="form-horizontal" method="post" action="{{ route('admin-seating-reservation-reserve', $currentseat->slug) }}">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Reserved for</div>
								</div>
								<input type="text" class="form-control" id="username" value="{{ User::getFullnameAndNicknameByID(Sentinel::getUser()->id) }}" autocomplete="off">
								<span class="input-group-append">
									<button class="btn btn-success" type="submit"><i class="fas fa-hand-paper mr-2"></i>Reserve Seat</button>
								</span>
								@if($errors->has('reservedfor'))
									<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
								@endif
							</div>
							<input type="hidden" id="reservedfor" name="reservedfor" value="{{ Sentinel::getUser()->id }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@stop

@section('javascript')
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#username').typeahead({
					onSelect: function(item) {
						document.getElementById("reservedfor").value = item.value;
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/usernames",
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