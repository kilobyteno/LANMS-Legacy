@extends('layouts.main')
@section('title', 'Styling - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Styling</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Styling</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
						<thead>
							<tr>
								<th>File</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($files as $file)
								<tr>
									<td scope="row">{{ substr($file, strrpos($file, '/') + 1) }}</td>
									<td>
										<a href="{{ route('admin-seating-styling-edit', substr($file, strrpos($file, '/') + 1)) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
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
		        "order": [0, "asc"],
		    	responsive: true
		    });
		} );
	</script>
@stop