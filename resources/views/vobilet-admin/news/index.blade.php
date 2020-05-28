@extends('layouts.main')
@section('title', 'News - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">News @if(Sentinel::hasAccess('admin.news.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-news-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">News</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">

				<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>Category</th>
							<th>Published at</th>
							<th>Created by</th>
							<th>Updated at</th>
							<th>Updated by</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($news as $article)
							<tr>
								<th scope="row">{{ $article->id }}</th>
								<td>{{ $article->title }}</td>
								<td><a href="{{ route('admin-news-category') }}"><div class="badge badge-info"><i class="fa fa-tag"></i> {{ $article->category->name }}</div></a></td>
								<td>{{ \Carbon::parse($article->published_at)->toDateTimeString() }}</td>
								<td><a href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a></td>
								<td>{{ \Carbon::parse($article->updated_at)->toDateTimeString() }}</td>
								<td><a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></td>
								<td>
									<a href="{{ route('news-show', $article->slug) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>View</a>
									<a href="{{ route('admin-news-edit', $article->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.news.destroy'))
										<a href="javascript:;" onclick="jQuery('#news-destroy-{{ $article->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Delete</a>
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

@foreach($news as $article)
	<div class="modal fade" id="news-destroy-{{ $article->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Article:</strong> #{{ $article->id }} - {{ $article->title }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this article?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-news-destroy', $article->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
		        "order": [0, "desc"],
		        responsive: true,
		    	"iDisplayLength": 25
		    });
		});
	</script>
@stop