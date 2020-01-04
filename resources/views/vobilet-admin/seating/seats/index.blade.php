@extends('layouts.main')
@section('title', 'Seats - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Seats @if(Sentinel::hasAccess('admin.seating.seat.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-seating-seat-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Seats</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Ticket Type</th>
							<th>Row</th>
							<th>Status</th>
							<th>Updated at</th>
							<th>Updated by</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allseats as $seat)
							<tr>
								<th scope="row">{{ $seat->id }}</th>
								<td>{{ $seat->name }}</td>
								<td>{{ $seat->tickettype ? $seat->tickettype->name : 'N/A' }}</td>
								<td>{{ $seat->row->name ?? 'N/A' }}</td>
								<td>{!! ($seat->deleted_at) ? '<span class="badge badge-danger">Deleted</span>' : '<span class="badge badge-info">Active</span>' !!}</td>
								<td>{{ \Carbon::parse($seat->updated_at)->toDateTimeString() }}</td>
								<td><a href="{{ URL::route('user-profile', $seat->editor->username) }}">{{ User::getFullnameByID($seat->editor->id) }}</a></td>
								<td>
									<a href="{{ route('admin-seating-seat-edit', $seat->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.seating.seat.destroy') && !$seat->deleted_at)
										<a href="javascript:;" onclick="jQuery('#seat-destroy-{{ $seat->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Delete</a>
									@endif
									@if(Sentinel::hasAccess('admin.seating.seat.destroy') && $seat->deleted_at)
										<a href="{{ route('admin-seating-seat-restore', $seat->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-redo mr-2"></i>Restore</a>
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

@foreach($allseats as $seat)
	<div class="modal fade" id="seat-destroy-{{ $seat->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Seat:</strong> #{{ $seat->id }} - {{ $seat->name }}</h4>
				</div>
				<div class="modal-body text-center">
					<h4 class="text-danger"><strong>Are you sure you want to delete this seat?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-seating-seat-destroy', $seat->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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