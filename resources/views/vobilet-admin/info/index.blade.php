@extends('layouts.main')
@section('title', 'Info - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Info</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Info</li>
	</ol>
</div>

<div class="row">
	<div class="col-12">

		<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
			<thead>
				<tr>
					<th>Name</th>
					<th>Content</th>
					<th>Description</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($allinfo as $info)
					<tr>
						<td scope="row">{{ $info->name }}</td>
						<td>{{ $info->content }}</td>
						<td>{{ $info->description ?? '' }}</td>
						<td>
							<a href="{{ route('admin-info-edit', $info->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

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
		    	responsive: true,
		    	"iDisplayLength": 25
		    });
		} );
	</script>
@stop