@extends('layouts.main')
@section('title', 'Settings - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Settings</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-users') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Settings</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">

		<div class="alert alert-danger" role="alert"><strong><i class="fa fa-exclamation-triangle mr-2"></i> IMPORTANT!</strong> You need to know what you are doing. If you do not know what you are doing you will cause errors on the website. Please be carefull! Ask support if you need help.</div>

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
						<thead>
							<tr>
								<th>Key</th>
								<th>Value</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($settings as $key => $value)
								<tr>
									<td scope="row">{{ $key }}</td>
									<td>{{ $value }}</td>
									<td>
										<a href="{{ route('admin-settings-edit', $key) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
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