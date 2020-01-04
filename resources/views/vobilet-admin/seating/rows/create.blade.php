@extends('layouts.main')
@section('title', 'Create Row - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Row</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-rows') }}">Rows</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<form action="{{ route('admin-seating-row-store') }}" method="post">

			<div class="row">
				<div class="col-4">
					<div class="expanel expanel-default @if($errors->has('name')) panel-danger @endif" data-collapsed="0">
						<div class="expanel-heading">
							<div class="expanel-title">Name</div>
						</div>
						<div class="expanel-body">
							<input type="text" class="form-control input-lg" name="name" placeholder="A" value="{{ (old('name')) ? old('name') : '' }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="expanel expanel-default @if($errors->has('tickettype')) panel-danger @endif" data-collapsed="0">
						<div class="expanel-heading">
							<div class="expanel-title">Ticket Type to add to seats</div>
						</div>
						<div class="expanel-body">
							<select name="tickettype" class="form-control">
								<option value="">-- No ticket --</option>
								@foreach($ticket_types as $tickettype)
									<option value="{{ $tickettype->id }}">{{ $tickettype->title }}</option>
								@endforeach
							</select>
							@if($errors->has('tickettype'))
								<p class="text-danger">{{ $errors->first('tickettype') }}</p>
							@endif
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="expanel expanel-default @if($errors->has('seat_count')) panel-danger @endif" data-collapsed="0">
						<div class="expanel-heading">
							<div class="expanel-title">Seats to add</div>
						</div>
						<div class="expanel-body">
							<input type="number" class="form-control input-lg" name="seat_count" placeholder="0" min="0" max="100" value="{{ (old('seat_count')) ? old('seat_count') : '' }}" />
							@if($errors->has('seat_count'))
								<p class="text-danger">{{ $errors->first('seat_count') }}</p>
							@endif
						</div>
					</div>
				</div>
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-save mr-2"></i>Save</button>
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
</div>

@stop