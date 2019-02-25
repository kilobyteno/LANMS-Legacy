@extends('layouts.main')
@section('title', 'Create Compo - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Compo</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-compo') }}">Compo</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Compo</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-compo-store') }}" method="post">

					<div class="row">
						
						<div class="col-xl-12">
							<div class="input-group">
								<input type="text" class="form-control input-lg" name="name" autocomplete="off" placeholder="Name" value="{{ (old('name')) ? old('name') : '' }}" />
								<span class="input-group-append">
									<button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save</button>
								</span>
								@if($errors->has('name'))
									<p class="text-danger">{{ $errors->first('name') }}</p>
								@endif
							</div>
						</div>

					</div>

					<div class="row mt-5">
						
						<div class="col-xl-6">
							<div class="input-group">
								<span class="input-group-prepend">
									<span class="input-group-text">Challonge Subdomain</span>
								</span>
								<input type="text" class="form-control input-lg" name="challonge_subdomain" autocomplete="off" placeholder="Challonge Subdomain" value="{{ (old('challonge_subdomain')) ? old('challonge_subdomain') : '' }}" />
								@if($errors->has('challonge_subdomain'))
									<p class="text-danger">{{ $errors->first('challonge_subdomain') }}</p>
								@endif
							</div>
						</div>

						<div class="col-xl-6">
							<div class="input-group">
								<span class="input-group-prepend">
									<span class="input-group-text">Challonge URL</span>
								</span>
								<input type="text" class="form-control input-lg" name="challonge_url" autocomplete="off" placeholder="Challonge URL" value="{{ (old('challonge_url')) ? old('challonge_url') : '' }}" />
								@if($errors->has('challonge_url'))
									<p class="text-danger">{{ $errors->first('challonge_url') }}</p>
								@endif
							</div>
						</div>
						
					</div>

					<div class="row mt-5">
						
						<div class="col-xl-3">
							<div class="input-group">
								<label class="form-label">Type:</label>
								<select name="type" class="select2">
									<option value="1" selected="">Brackets</option>
									<option value="2">Submissions</option>
								</select>
							</div>
						</div>

						<div class="col-xl-3">
							<div class="input-group">
								<label class="form-label">Signup Type:</label>
								<select name="signup_type" id="signup_type" class="select2">
									<option value="1" selected="">Team</option>
									<option value="2">Individual</option>
								</select>
							</div>
						</div>

						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label">Signup Size:</label>
								<input type="number" class="form-control" name="signup_size" id="signup_size">
							</div>
						</div>

						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label">Rules Page:</label>
								<select name="page_id" id="page_id" class="select2">
									<option>--- {{ trans('global.pleaseselect') }} ---</option>
									@foreach(\LANMS\Page::all() as $page)
										<option value="{{ $page->id }}">{{ $page->title }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
					</div>

					<div class="row">
						
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label">Description:</label>
								<textarea class="form-control input-lg" name="description" autocomplete="off" placeholder="Description">{{ (old('description')) ? old('description') : '' }}</textarea>
								@if($errors->has('description'))
									<p class="text-danger">{{ $errors->first('description') }}</p>
								@endif
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
			$('.select2').select2({minimumResultsForSearch:-1});
			$('#page_id').select2();
			$('#signup_type').on('change', function () {
				var ogValue = 1;
				switch (this.value) {
					case '1':
						$('#signup_size').attr({
							"min" : 1,
							"max" : 10,
						});
						$('#signup_size').val("1");
						break;
					case '2':
						$('#signup_size').attr({
							"min" : 1,
							"max" : 1,
						});
						$('#signup_size').val("1");
						break;
				}
			})
		});
	</script>
@stop