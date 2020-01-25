@extends('layouts.main')
@section('title', 'Users - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Users</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Users</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Joined</th>
							<th>Last Updated</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<th scope="row">{{ $user->id }}</th>
								<td>{{ $user->username }}</td>
								<td>{{ $user->firstname }}</td>
								<td>{{ $user->lastname }}</td>
								<td>{{ \Carbon::parse($user->created_at)->toDateTimeString() }}</td>
								<td>{{ \Carbon::parse($user->updated_at)->toDateTimeString() }}</td>
								<td>@if(\Activation::completed($user) && !$user->deleted_at)<div class="badge badge-primary">Activated</div>@endif @if($user->last_login)<div class="badge badge-info">Has logged in</div>@endif @if($user->deleted_at)<div class="badge badge-secondary">Deactivated</div>@endif @if($user->isAnonymized)<div class="badge badge-danger">Anonymized</div>@endif</td>
								<td>
									<a href="{{ route('user-profile', $user->username) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>View</a>
									<a href="{{ route('admin-user-edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.users.destroy') && !$user->deleted_at)
										<a href="javascript:;" onclick="jQuery('#user-destroy-{{ $user->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="fas fa-trash mr-2"></i>Deactivate</a>
									@endif
									@if(Sentinel::hasAccess('admin.users.restore') && $user->deleted_at)
										<a href="{{ route('admin-user-restore', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-redo mr-2"></i>Restore</a>
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

@foreach($users as $user)
	<div class="modal fade" id="user-destroy-{{ $user->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Deactivate User:</strong> #{{ $user->id }} - {{ $user->username }} ({{ $user->firstname }} {{ $user->lastname }})</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to deactivate this user?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-user-destroy', $user->id) }}" class="btn btn-danger">Yes, I want to deactivate it.</a>
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
		    	responsive: true,
		    	"iDisplayLength": 25
		    });
		} );
	</script>
@stop