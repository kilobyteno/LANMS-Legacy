@extends('layouts.main')
@section('title', 'Roles - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Roles @if(Sentinel::hasAccess('admin.role.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-role-create') }}"><i class="fa fa-plus mr-2"></i> Create</a><a class="btn btn-sm btn-info ml-2" href="{{ route('admin-roles-refreshpermissions') }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="This will add missing permissions to all roles and set them to false."><i class="fas fa-sync mr-2"></i> Refresh Permissions</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Roles</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="alert alert-warning" role="alert"><strong><i class="fa fa-exclamation-triangle mr-2"></i> IMPORTANT!</strong> You need to know what you are doing. Deleting or doing major changes to permissions can cause big permission issues. Please be careful!</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($roles as $role)
							<tr>
								<th scope="row">{{ $role->id }}</th>
								<td>{{ $role->name }}</td>
								<td>
									<a href="{{ route('admin-role-edit', $role->slug) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.role.destroy') && $role->slug !== 'superadmin' && $role->slug !== 'default' )
										<a href="javascript:;" onclick="jQuery('#destroy-{{ $role->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="fas fa-trash mr-2"></i>Delete</a>
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

@foreach($roles as $role)
	<div class="modal fade" id="destroy-{{ $role->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Role:</strong> #{{ $role->id }} - {{ $role->name }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this role?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-role-destroy', $role->slug) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		    	order: [0, "desc"],
		    });
		} );
	</script>
@stop