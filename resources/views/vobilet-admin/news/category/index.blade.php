@extends('layouts.main')
@section('title', 'News Categories - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">News Categories @if(Sentinel::hasAccess('admin.newscategory.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-news-category-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-news') }}">News</a></li>
		<li class="breadcrumb-item active" aria-current="page">Categories</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Slug</th>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<th scope="row">{{ $category->id }}</th>
						<td>{{ $category->slug }}</td>
						<td>{{ $category->name }}</td>
						<td>
							<!--<a href="{{ route('news-category-show', $category->slug) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>View</a>-->
							<a href="{{ route('admin-news-category-edit', $category->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.news.destroy'))
								<a href="javascript:;" onclick="jQuery('#category-destroy-{{ $category->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
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
					<h4 class="modal-title"><strong>Delete Category:</strong> #{{ $category->id }} - {{ $category->name }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this category?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-news-category-destroy', $category->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		        "order": [0, "desc"]
		    });
		});
	</script>
@stop