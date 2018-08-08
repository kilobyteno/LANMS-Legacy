@extends('layouts.main')
@section('title', 'Users - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Users</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Users</strong></li>
		</ol>

		<br />
		
		<table class="table table-bordered table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Joined</th>
					<th>Last Edited</th>
					<th>Last Login</th>
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
						<td>{{ date(User::getUserDateFormat(), strtotime($user->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($user->created_at)) }}</td>
						<td>{{ date(User::getUserDateFormat(), strtotime($user->updated_at)) .' at '. date(User::getUserTimeFormat(), strtotime($user->updated_at)) }}</td>
						<td>@if($user->last_login){{ date(User::getUserDateFormat(), strtotime($user->last_login)) .' at '. date(User::getUserTimeFormat(), strtotime($user->last_login)) }}@else{{'-'}}@endif</td>
						<td>
							<a href="{{ route('user-profile', $user->username) }}" class="btn btn-info btn-sm btn-icon icon-left"><i class="fa fa-eye"></i>View</a>
							<a href="{{ route('admin-user-edit', $user->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="fa fa-pencil-alt"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.users.destroy') && !$user->deleted_at)
								<a href="javascript:;" onclick="jQuery('#user-destroy-{{ $user->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="fa fa-trash"></i>Deactivate</a>
							@endif
							@if(Sentinel::hasAccess('admin.users.restore') && $user->deleted_at)
								<a href="{{ route('admin-user-restore', $user->id) }}" class="btn btn-primary btn-sm btn-icon icon-left"><i class="fa fa-redo"></i>Restore</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

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

@section('javascript')
	
	<script src="{{ Theme::url('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/TableTools.min.js') }}"></script>
	<script src="{{ Theme::url('js/dataTables.bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/jquery.dataTables.columnFilter.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/lodash.min.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/responsive/js/datatables.responsive.js') }}"></script>
	<script type="text/javascript">
		var responsiveHelper;
		var breakpointDefinition = {
		    tablet: 1024,
		    phone : 480
		};
		var tableContainer;
		
			jQuery(document).ready(function($)
			{
				tableContainer = $("#table-1");
				
				tableContainer.dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true,
					
		
				    // Responsive Settings
				    bAutoWidth     : false,
				    fnPreDrawCallback: function () {
				        // Initialize the responsive datatables helper once.
				        if (!responsiveHelper) {
				            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
				        }
				    },
				    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				        responsiveHelper.createExpandIcon(nRow);
				    },
				    fnDrawCallback : function (oSettings) {
				        responsiveHelper.respond();
				    }
				});
				
				$(".dataTables_wrapper select").select2({
					minimumResultsForSearch: -1
				});
			});
	</script>
@stop