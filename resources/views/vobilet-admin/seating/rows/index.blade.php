@extends('layouts.main')
@section('title', 'Rows - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Rows @if(Sentinel::hasAccess('admin.seating.row.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-seating-row-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Rows</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Slug</th>
							<th>Created at</th>
							<th>Created by</th>
							<th>Updated at</th>
							<th>Updated by</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allrows as $row)
							<tr>
								<th scope="row">{{ $row->id }}</th>
								<td>{{ $row->name }}</td>
								<td>{{ $row->slug }}</td>
								<td>{{ ucfirst(\Carbon::parse($row->created_at)->isoFormat('LLL')) }}</td>
								<td><a href="{{ URL::route('user-profile', $row->author->username) }}">{{ User::getFullnameByID($row->author->id) }}</a></td>
								<td>{{ ucfirst(\Carbon::parse($row->updated_at)->isoFormat('LLL')) }}</td>
								<td><a href="{{ URL::route('user-profile', $row->editor->username) }}">{{ User::getFullnameByID($row->editor->id) }}</a></td>
								<td>
									<a href="{{ route('admin-seating-row-edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.seating.row.destroy'))
										<a href="javascript:;" onclick="jQuery('#row-destroy-{{ $row->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		

	</div>
</div>

@foreach($allrows as $row)
	<div class="modal fade" id="row-destroy-{{ $row->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Row:</strong> #{{ $row->id }} - {{ $row->name }}</h4>
				</div>
				<div class="modal-body text-center">
					<h4 class="text-danger"><strong>Are you sure you want to delete this row?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-seating-row-destroy', $row->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
				</div>
			</div>
		</div>
	</div>
@endforeach

@stop
@section('css')
	<link href="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop
@section('javascript')
	<script src="{{ Theme::url('plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#table-1').DataTable();
		} );
	</script>
@stop