@extends('layouts.main')
@section('title', 'SMS - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">SMS @if(Sentinel::hasAccess('admin.sms.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-sms-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">SMS</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">

				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>Sent</th>
							<th>From</th>
							<th>To</th>
							<th>Segments</th>
							<th>Price</th>
							<th>Status</th>
							<th>Message</th>
						</tr>
					</thead>
					<tbody>
						@foreach($messages as $record)
							<tr>
								<td>{{ \Carbon::parse($record->dateSent) }}</td>
								<td>{{ $record->from }}</td>
								<td>{{ $record->to }}</td>
								<td>{{ $record->numSegments }}</td>
								<td>{{ $record->price.' '.strtoupper($record->priceUnit) }}</td>
								<td>{{ $record->status }}</td>
								<td>{{ $record->body }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
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
		    	responsive: true
		    });
		} );
	</script>
@stop