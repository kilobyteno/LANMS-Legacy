@extends('layouts.main')
@section('title', 'Pages - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Pages @if(Sentinel::hasAccess('admin.pages.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-pages-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Pages</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Slug</th>
					<th>Title</th>
					<th>Created at</th>
					<th>Created by</th>
					<th>Updated at</th>
					<th>Updated by</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pages as $page)
					<tr>
						<th scope="row">{{ $page->id }}</th>
						<td>{{ $page->slug }}</td>
						<td>{{ $page->title }}</td>
						<td>{{ ucfirst(\Carbon::parse($page->created_at)->isoFormat('LLL')) }}</td>
						<td><a href="{{ URL::route('user-profile', $page->author->username) }}">{{ User::getFullnameByID($page->author->id) }}</a></td>
						<td>@if($page->edited_at){{ ucfirst(\Carbon::parse($page->edited_at)->isoFormat('LLL')) }}@endif</td>
						<td>@if($page->editor->username)<a href="{{ URL::route('user-profile', $page->editor->username) }}">{{ User::getFullnameByID($page->editor->id) }}</a>@endif</td>
						<td>
							<a href="{{ route('page', $page->slug) }}" class="btn btn-info btn-sm"><i class="fa fa-eye mr-2"></i>View</a>
							<a href="{{ route('admin-pages-edit', $page->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.pages.destroy'))
								<a href="javascript:;" onclick="jQuery('#page-destroy-{{ $page->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@foreach($pages as $page)
	<div class="modal fade" id="page-destroy-{{ $page->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Page:</strong> #{{ $page->id }} - {{ $page->title }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this page?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-pages-destroy', $page->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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