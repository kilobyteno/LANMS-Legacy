@extends('layouts.main')
@section('title', 'Crew Categories - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Crew Categories @if(Sentinel::hasAccess('admin.crew-category.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-crew-category-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew') }}">Crew</a></li>
		<li class="breadcrumb-item active" aria-current="page">Categories</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
			<thead>
				<tr>
					<th>Title</th>
					<th>Created at</th>
					<th>Created by</th>
					<th>Updated at</th>
					<th>Updated by</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{ $category->title }}</td>
						<td>{{ ucfirst(\Carbon::parse($category->created_at)->isoFormat('LLL')) }}</td>
						<td><a href="{{ URL::route('user-profile', $category->author->username) }}">{{ User::getFullnameByID($category->author->id) }}</a></td>
						<td>{{ ucfirst(\Carbon::parse($category->updated_at)->isoFormat('LLL')) }}</td>
						<td><a href="{{ URL::route('user-profile', $category->editor->username) }}">{{ User::getFullnameByID($category->editor->id) }}</a></td>
						<td>
							<a href="{{ route('admin-crew-category-edit', $category->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.crew.destroy'))
								<a href="javascript:;" onclick="jQuery('#category-destroy-{{ $category->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Delete</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@foreach($categories as $category)
	<div class="modal fade" id="category-destroy-{{ $category->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Category:</strong> #{{ $category->id }} - {{ $category->title }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this category?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-crew-category-destroy', $category->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		    $('#table-1').DataTable({
		    	order: [0, "asc"],
		    });
		} );
	</script>
@stop