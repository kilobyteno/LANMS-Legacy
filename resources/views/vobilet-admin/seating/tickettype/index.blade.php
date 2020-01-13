@extends('layouts.main')
@section('title', 'Ticket Type - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Ticket Types @if(Sentinel::hasAccess('admin.seating.tickettype.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-seating-tickettype-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Ticket Types</li>
	</ol>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Color</th>
							<th>Status</th>
							<th>Updated at</th>
							<th>Updated by</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ticket_types as $tickettype)
							<tr>
								<th scope="row">{{ $tickettype->id }}</th>
								<td>{{ $tickettype->name }}</td>
								<td>{{ $tickettype->description }}</td>
								<td>{{ $tickettype->price }}</td>
								<td style="background-color: #{{ $tickettype->color }};color:#fff">#{{ $tickettype->color }}</td>
								<td>{!! ($tickettype->active && !$tickettype->deleted_at) ? '<span class="badge badge-info">Visible</span>' : '<span class="badge badge-default">Invisible</span>' !!}{!! ($tickettype->deleted_at) ? '<span class="badge badge-danger">Deleted</span>' : '' !!}</td>
								<td>{{ \Carbon::parse($tickettype->updated_at)->toDateTimeString() }}</td>
								<td><a href="{{ URL::route('user-profile', $tickettype->editor->username) }}">{{ User::getFullnameByID($tickettype->editor->id) }}</a></td>
								<td>
									<a href="{{ route('admin-seating-tickettype-edit', $tickettype->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.seating.tickettype.destroy') && !$tickettype->deleted_at)
										<a href="javascript:;" onclick="jQuery('#tickettype-destroy-{{ $tickettype->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
									@endif
									@if(Sentinel::hasAccess('admin.seating.tickettype.destroy') && $tickettype->deleted_at)
										<a href="{{ route('admin-seating-tickettype-restore', $tickettype->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-redo mr-2"></i>Restore</a>
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

@foreach($ticket_types as $tickettype)
	<div class="modal fade" id="tickettype-destroy-{{ $tickettype->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Row:</strong> #{{ $tickettype->id }} - {{ $tickettype->name }}</h4>
				</div>
				<div class="modal-body text-center">
					<h4 class="text-danger"><strong>Are you sure you want to delete this ticket type?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-seating-tickettype-destroy', $tickettype->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		    $('#table-1').DataTable({
		        "order": [3, "asc"]
		    });
		} );
	</script>
@stop