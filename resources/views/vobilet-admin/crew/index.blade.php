@extends('layouts.main')
@section('title', 'Crew - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Crew @if(Sentinel::hasAccess('admin.crew.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-crew-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Crew</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>Name</th>
							<th>Category</th>
							<th>Created at</th>
							<th>Created by</th>
							<th>Updated at</th>
							<th>Updated by</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($crewassignment as $crew)
							<tr>
								<td scope="row">{{ $crew->user->fullname() ?? 'N/A' }}</td>
								<td>{{ $crew->category->title ?? 'N/A' }}</td>
								<td>{{ \Carbon::parse($crew->created_at)->toDateTimeString() }}</td>
								<td><a href="{{ URL::route('user-profile', $crew->author->username) }}">{{ $crew->author->fullname() }}</a></td>
								<td>{{ \Carbon::parse($crew->updated_at)->toDateTimeString() }}</td>
								<td><a href="{{ URL::route('user-profile', $crew->editor->username) }}">{{ $crew->editor->fullname() }}</a></td>
								<td>
									<a href="{{ route('admin-crew-edit', $crew->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.crew.destroy'))
										<a href="javascript:;" onclick="jQuery('#crew-destroy-{{ $crew->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
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

@foreach($crewassignment as $crew)
	<div class="modal fade" id="crew-destroy-{{ $crew->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Crew:</strong> #{{ $crew->id }} - {{ $crew->user->fullname() }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this crew?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-crew-destroy', $crew->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		    	order: [0, "asc"],
		    	responsive: true,
		    	"iDisplayLength": 25
		    });
		} );
	</script>
@stop