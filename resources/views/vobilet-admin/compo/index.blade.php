@extends('layouts.main')
@section('title', 'Compo - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Compo @if(Sentinel::hasAccess('admin.compo.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-compo-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Compo</li>
	</ol>
</div>

<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-body">

				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>Name</th>
							<th>Year</th>
							<th>Start at</th>
							<th>Last sign up at</th>
							<th>End at</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($compos as $compo)
							<tr>
								<td>{{ $compo->name }}</td>
								<td>{{ $compo->year }}</td>
								<td>{{ \Carbon::parse($compo->start_at)->toDateTimeString() }}</td>
								<td>{{ \Carbon::parse($compo->last_sign_up_at)->toDateTimeString() }}</td>
								<td>{{ \Carbon::parse($compo->end_at)->toDateTimeString() }}</td>
								<td>
									@if($compo->year != \Setting::get('SEATING_YEAR'))
										<span class="badge badge-dark">Previous</span>
									@elseif($compo->deleted_at)
										<span class="badge badge-danger">Deleted</span>
									@elseif(!$compo->deleted_at)
										<span class="badge badge-info">Visible</span>
									@endif									
								</td>
								<td>
									<a href="{{ route('compo-show', $compo->slug) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>View</a>
									@if($compo->year == \Setting::get('SEATING_YEAR'))
										<a href="{{ route('admin-compo-edit', $compo->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
										@if(Sentinel::hasAccess('admin.compo.destroy') && !$compo->deleted_at)
											<a href="javascript:;" onclick="jQuery('#compo-destroy-{{ $compo->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
										@endif
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

@foreach($compos as $compo)
	<div class="modal fade" id="compo-destroy-{{ $compo->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Compo:</strong> #{{ $compo->id }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this compo?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-compo-destroy', $compo->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		    	order: [1, "desc"],
		    	responsive: true,
		    	"iDisplayLength": 25
		    });
		} );
	</script>
@stop