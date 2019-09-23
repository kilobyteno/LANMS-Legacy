@extends('layouts.main')
@section('title', 'Emails - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Emails @if(Sentinel::hasAccess('admin.emails.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-emails-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Emails</li>
	</ol>
</div>

<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>Sent</th>
							<th>Subject</th>
							<th>Sent to</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($emails as $email)
							<tr>
								<td scope="row">{{ $email->created_at }}</td>
								<td>{{ $email->subject ?? 'N/A' }}</td>
								<td>{{ $email->users->count() }} users</td>
								<td>
									<a href="{{ route('admin-emails-show', $email->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>Show</a>
								</td>
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