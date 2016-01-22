@extends('layouts.main')
@section('title', 'Pages - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Pages @if(Sentinel::hasAccess('admin.pages.create'))<a class="btn btn-lg btn-success btn-icon icon-left pull-right" href="{{ route('admin-pages-create') }}"><i class="fa fa-plus"></i> Create Page</a>@endif</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Pages</strong></li>
		</ol>

		<br />
		
		<table class="table table-bordered table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Slug</th>
					<th>Title</th>
					<th>Created at</th>
					<th>Created by</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pages as $page)
					<tr>
						<th scope="row">{{ $page->id }}</th>
						<td>{{ $page->slug }}</td>
						<td>{{ $page->title }}</td>
						<td>{{ date(User::getUserDateFormat(), strtotime($page->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($page->created_at)) }}</td>
						<td><a href="{{ URL::route('user-profile', User::getUsernameByID($page->author_id)) }}">{{ User::getFullnameByID($page->author_id) }}</a></td>
						<td>
							<a href="{{ route('admin-pages-edit', $page->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.pages.destroy'))
								<a href="javascript:;" onclick="jQuery('#page-destroy-{{ $page->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							@endif
							<a href="{{ route('page', $page->slug) }}" class="btn btn-info btn-sm btn-icon icon-left"><i class="entypo-info"></i>View</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@foreach($pages as $page)
	<div class="modal fade" id="page-destroy-{{ $page->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Page:</strong> #{{ $page->id }} - {{ $page->title }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this page?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-pages-destroy', $page->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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