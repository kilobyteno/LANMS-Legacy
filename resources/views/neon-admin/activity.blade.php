@extends('layouts.main')
@section('title', 'Activity Log - Admin')
	 
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Activity Log</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Activity Log</strong></li>
		</ol>

		<br />

		<div class="row">
			<div class="col-sm-12 table-container">
				<table class="table table-bordered table-hover datatable" id="table-1">
					<thead>
						<tr>
							<th>Date and time</th>
							<th>Log Name</th>
							<th>Description</th>
							<th>Subject</th>
							<th>Causer</th>
							<th>Old Value</th>
							<th>New Value</th>
						</tr>
					</thead>
					<tbody>
						@foreach($activities as $activity)
							<tr>
								<td>{{ $activity->created_at }}</td>
								<td>{{ $activity->log_name }}</td>
								<td>{{ $activity->description }}</td>
								<td>{{ $activity->subject_type }} ID: {{ $activity->subject_id }}</td>
								<td>{{ $activity->causer_type }} ID: {{ $activity->causer_id }}</td>
								<td>{{ $activity->oldvalue }}</td>
								<td>{{ $activity->newvalue }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
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
					"order": [[ 0, "desc" ]],
		
				    // Responsive Settings
				    bAutoWidth     : true,
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