@extends('layouts.main')
@section('title', 'Sponsor - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Sponsor @if(Sentinel::hasAccess('admin.sponsor.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-sponsor-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Sponsor</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>Sort Order</th>
							<th>Name</th>
							<th>Description</th>
							<th>URL</th>
							<th>Image</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sponsors as $sponsor)
							<tr>
								<td scope="row">{{ $sponsor->sort_order }}</td>
								<td>{{ $sponsor->name }}</td>
								<td>{{ $sponsor->description }}</td>
								<td><a href="{{ $sponsor->url }}" target="_blank">{{ $sponsor->url }}</a></td>
								<td><div class="hover_img"><a href="#">Hover to show image<span><img src="{{ $sponsor->image }}" alt="{{ $sponsor->name }}" /></span></a></div></td>
								<td>
									<a href="{{ route('admin-sponsor-edit', $sponsor->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.sponsor.destroy'))
										<a href="javascript:;" onclick="jQuery('#sponsor-destroy-{{ $sponsor->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
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

@foreach($sponsors as $sponsor)
	<div class="modal fade" id="sponsor-destroy-{{ $sponsor->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Sponsor:</strong> #{{ $sponsor->id }} - {{ $sponsor->name }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this sponsor?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-sponsor-destroy', $sponsor->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
				</div>
			</div>
		</div>
	</div>
@endforeach

@stop

@section('css')
	<link href="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<style type="text/css">
		.hover_img a { position:relative; }
		.hover_img a span { position:absolute; display:none; z-index:99; }
		.hover_img a:hover span { display:block; }
		.hover_img img { background: rgba(255,255,255,0.8); padding: 3px; border: 1px rgba(0,0,0,0.8) solid; border-radius: 5px; height: auto; width: auto; max-width: 250px; max-height: 100px; }
	</style>
@stop
@section('javascript')
	<script src="{{ Theme::url('plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#table-1').DataTable({
		        "order": [0, "asc"]
		    });
		} );
	</script>
@stop