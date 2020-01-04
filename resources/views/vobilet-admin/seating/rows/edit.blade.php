@extends('layouts.main')
@section('title', 'Edit Row - #'.$row->id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Row: {{ $row->name }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-rows') }}">Rows</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Row: #{{ $row->id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-12">

		<form action="{{ route('admin-seating-row-update', $row->id) }}" method="post" class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" class="form-control input-lg" name="name" placeholder="A" value="{{ (old('name')) ? old('name') : $row->name }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label class="form-control-label">Set ticket type to all seats</label>
							
							<select name="tickettype" class="select2">
								<option value="nothing">-- Nothing --</option>
								<option value="">-- No ticket --</option>
								@foreach($ticket_types as $tickettype)
									<option value="{{ $tickettype->id }}">{{ $tickettype->name }}</option>
								@endforeach
							</select>
							<p class="text-muted"><em><small>This will reset whatever the seat had before. If "Nothing" is selected, nothing will happen.</small></em></p>
							@if($errors->has('tickettype'))
								<p class="text-danger">{{ $errors->first('tickettype') }}</p>
							@endif
						</div>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Save</button>
			</div>
		</form>

	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		(function($) {
			$('.select2').select2();
		})(jQuery);
	</script>
@stop