@extends('layouts.main')
@section('title', 'Crew Skill - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Crew Skill @if(Sentinel::hasAccess('admin.crew-skill.create'))<a class="btn btn-sm btn-success ml-2" href="{{ route('admin-crew-skill-create') }}"><i class="fa fa-plus mr-2"></i> Create</a>@endif</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew') }}">Crew</a></li>
		<li class="breadcrumb-item active" aria-current="page">Skill</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<table class="table table-striped table-bordered dataTable no-footer" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Icon</th>
					<th>Class</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($skills as $skill)
					<tr>
						<th scope="row">{{ $skill->id }}</th>
						<td>{{ $skill->title }}</td>
						<td><i class="{{ $skill->icon }}"></i> {{ $skill->icon }}</td>
						<td><span class="{{ $skill->class }}">{{ $skill->class }}</span></td>
						<td>
							<a href="{{ route('admin-crew-skill-edit', $skill->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.crew.destroy'))
								<a href="javascript:;" onclick="jQuery('#skill-destroy-{{ $skill->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Delete</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@foreach($skills as $skill)
	<div class="modal fade" id="skill-destroy-{{ $skill->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Category:</strong> #{{ $skill->id }} - {{ $skill->title }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this skill?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-crew-skill-destroy', $skill->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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