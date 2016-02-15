@extends('layouts.main')
@section('title', 'Reservations - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Reservations</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-seating') }}">Seating</a></li>
			<li class="active"><strong>Reservations</strong></li>
		</ol>

		<br />
		
		<table class="table table-bordered table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Seat</th>
					<th>Reserved for</th>
					<th>Reserved by</th>
					<th>Reserved at</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reservations as $reservation)
					<tr>
						<th scope="row">{{ $reservation->id }}</th>
						<td>{{ $reservation->seat->name }}</td>
						<td><a href="{{ URL::route('user-profile', $reservation->reservedfor->username) }}">{{ User::getFullnameByID($reservation->reservedfor->id) }}</a></td>
						<td><a href="{{ URL::route('user-profile', $reservation->reservedby->username) }}">{{ User::getFullnameByID($reservation->reservedby->id) }}</a></td>
						<td>{{ date(User::getUserDateFormat(), strtotime($reservation->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($reservation->created_at)) }}</td>
						<td>
							<a href="{{ route('admin-seating-reservation-edit', $reservation->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>
							<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="btn btn-info btn-sm btn-icon icon-left"><i class="entypo-info"></i>View</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

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