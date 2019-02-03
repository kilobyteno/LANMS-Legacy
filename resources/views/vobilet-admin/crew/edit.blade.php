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
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="far fa-user"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg disabled" disabled="" value="{{ User::getFullnameAndNicknameByID($crew->user->id) }}" />
							</div>
						</div>

						<div class="col-sm-5 @if($errors->has('category_id')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-tag"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" id="category" placeholder="Crew Category" value="{{ $crew->category->title ?? '' }}" autocomplete="OFF">
								<input type="hidden" id="category_id" name="category_id" value="{{ $crew->category->id ?? '' }}">
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
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#category').typeahead({
					onSelect: function(item) {
						document.getElementById("category_id").value = item.value;
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/crew/categories",
						timeout: 500,
						displayField: "title",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop