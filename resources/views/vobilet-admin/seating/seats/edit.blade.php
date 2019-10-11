@extends('layouts.main')
@section('title', 'Edit Seat - #'.$seat->id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Seat: #{{ $seat->id }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-seats') }}">Seats</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Seat: #{{ $seat->id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-seating-seat-update', $seat->id) }}" method="post">

					<div class="row">

						<div class="col-sm-5">
							<div class="form-group">
								<label class="form-control-label">Name</label>
								<input type="text" class="form-control input-lg" name="name" placeholder="A1" value="{{ (old('name')) ? old('name') : $seat->name }}" />
								@if($errors->has('name'))
									<p class="text-danger">{{ $errors->first('name') }}</p>
								@endif
							</div>
						</div>

						<div class="col-sm-5">
							<div class="form-group">
								<label class="form-control-label">Row</label>
								<select name="row_id" class="select2">
									@foreach(\LANMS\SeatRows::withTrashed()->get() as $row)
										<option value="{{ $row->id }}" @if($seat->row) @if($row->id == $seat->row->id) selected @endif @endif>{{ $row->name }}</option>
									@endforeach
								</select>
								@if($errors->has('row_id'))
									<p class="text-danger">{{ $errors->first('row_id') }}</p>
								@endif
							</div>
						</div>

						<div class="col-sm-2">
							<button type="submit" class="btn btn-success btn-block"><i class="fas fa-save mr-2"></i>Save</button>
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
			$('.select2').select2();
		})(jQuery);
	</script>
@stop