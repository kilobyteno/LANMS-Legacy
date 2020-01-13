@extends('layouts.main')
@section('title', 'Reservations - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Reservations</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Reservations</li>
	</ol>
</div>

<div class="row">
	<div class="col-12 col-xl-4">
		@include('seating.seatmap')
	</div>
	<div class="col-12 col-xl-8">
		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>Seat</th>
							<th>Ticket ID</th>
							<th>Payment ID</th>
							<th>Reserved for</th>
							<th>Reserved by</th>
							<th>Reserved at</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($reservations as $reservation)
							<tr>
								<td>{{ $reservation->seat->name }}</td>
								<td>{{ $reservation->ticket->barcode ?? 'N/A' }}</td>
								<td>{{ $reservation->payment->id ?? 'N/A' }}</td>
								<td><a href="{{ URL::route('user-profile', $reservation->reservedfor->username) }}">{{ User::getFullnameByID($reservation->reservedfor->id) }}</a></td>
								<td><a href="{{ URL::route('user-profile', $reservation->reservedby->username) }}">{{ User::getFullnameByID($reservation->reservedby->id) }}</a></td>
								<td>{{ \Carbon::parse($reservation->created_at)->toDateTimeString() }}</td>
								<td>
									<a href="{{ route('admin-seating-reservation-show', $reservation->seat->slug) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>View</a>
									<a href="{{ route('admin-seating-reservation-edit', $reservation->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.reservation.destroy'))
										<a href="javascript:;" onclick="jQuery('#reservation-destroy-{{ $reservation->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Delete</a>
									@endif
									@if($reservation->ticket)
										<a href="{{ route('admin-seating-reservation-pdf', $reservation->seat->slug) }}" class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf mr-2"></i>Ticket</a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@foreach($reservations as $reservation)
	<div class="modal fade" id="reservation-destroy-{{ $reservation->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Reservation:</strong> #{{ $reservation->id }}</h4>
				</div>
				<div class="modal-body text-center">
					<h4 class="text-danger"><strong>Are you sure you want to delete this reservation?</strong></h4>
					<p><strong>Seat:</strong> {{ $reservation->seat->name }}</p>
					<p><strong>Reserved for:</strong> {{ User::getFullnameByID($reservation->reservedfor->id) }}</p>
					<p><strong>Reserved by:</strong> {{ User::getFullnameByID($reservation->reservedby->id) }}</p>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-seating-reservation-destroy', $reservation->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
				</div>
			</div>
		</div>
	</div>
@endforeach

@stop

@section('css')
	<link href="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop
@section('javascript')
	<script src="{{ Theme::url('plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#table-1').DataTable();
		} );
	</script>
@stop