@extends('layouts.main')
@section('title', 'Activity Log - Admin')
	 
@section('content')

<div class="page-header">
	<h4 class="page-title">Activity Log</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Activity Log</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="card">
			<div class="card-body">
            	<div class="table-responsive">
            		<table class="table table-striped table-bordered dataTable no-footer" id="table-1" role="grid">
						<thead>
							<tr>
								<th>ID</th>
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
									<td>{{ $activity->id }}</td>
									<td>{{ ucfirst(\Carbon::parse($activity->created_at)->isoFormat('LLL')) }}</td>
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
			<!-- table-wrapper -->
		</div>
	</div>
</div>
@stop
@section('css')
	<link href="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('plugins/datatable/responsive/css/responsive.bootstrap4.css') }}" rel="stylesheet">
@stop
@section('javascript')
	<script src="{{ Theme::url('plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/responsive/js/datatables.responsive.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/responsive/js/responsive.bootstrap4.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#table-1').DataTable({
		    	order: [0, "desc"],
		    	responsive: true
		    });
		} );
	</script>
@stop