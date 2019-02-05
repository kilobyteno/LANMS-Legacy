@extends('layouts.main')
@section('title', 'Edit Crew: #'.$crew->id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Crew: #{{ $crew->id }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew') }}">Crew</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Crew: #{{ $crew->id }}</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-crew-update', $crew->id) }}" method="post">

					<div class="row">

						<div class="col-sm-5">
							<div class="form-group">
								<label class="form-label">User:</label>
								<input type="text" class="form-control input-lg disabled" disabled="" value="{{ User::getFullnameAndNicknameByID($crew->user->id) }}" />
							</div>
						</div>

						<div class="col-sm-5">
							<div class="form-group">
								<label class="form-label">Category:</label>
								<select name="category_id" class="select2">
									@foreach(\CrewCategory::all() as $category)
										<option value="{{ $category->id }}" @if($crew->category->id == $category->id) selected="" @endif>{{ $category->title }}</option>
									@endforeach
								</select>
							</div>
							@if($errors->has('category_id'))
								<p class="text-danger">{{ $errors->first('category_id') }}</p>
							@endif
						</div>

						<div class="col-sm-2">
							<button type="submit" class="btn btn-success btn-block btn-icon"><i class="fa fa-save mr-2"></i>Save</button>
						</div>

					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group mt-4 mb-0">
								<label class="form-label">Skills:</label>
								@foreach(\LANMS\CrewSkill::orderBy('title', 'asc')->get() as $skill)
		                        	<label class="custom-control custom-checkbox mr-2" style="display: inline-block;">
										<input type="checkbox" class="custom-control-input" name="skills[]" value="{{ $skill->id }}" @if(in_array($skill->id, $crew->skills->pluck('id')->toArray())) checked @endif>
										<span class="custom-control-label">{{ $skill->title }}</span>
									</label>
		                        @endforeach
							</div>
						</div>
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>
			</div>
		</div>
	</div>
</div>

@stop
@section('javascript')
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
@stop