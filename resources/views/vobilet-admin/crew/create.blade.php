@extends('layouts.main')
@section('title', 'Create Crew - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Crew</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-crew') }}">Crew</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Crew</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-crew-store') }}" method="post">

					<!-- Title and Publish Buttons -->
					<div class="row">

						<div class="col-sm-5 @if($errors->has('user_id')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="far fa-user"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" id="username" placeholder="User" value="" autocomplete="OFF" />
							</div>
							<input type="hidden" id="user_id" name="user_id" value="{{ Sentinel::getUser()->id }}">
							@if($errors->has('user_id'))
								<p class="text-danger">{{ $errors->first('user_id') }}</p>
							@endif
						</div>

						<div class="col-sm-5 @if($errors->has('category_id')) has-error @endif">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-tag"></i>
									</div>
								</div>
								<input type="text" class="form-control input-lg" id="category" placeholder="Crew Category" value="" autocomplete="OFF">
								<input type="hidden" id="category_id" name="category_id" value="0">
							</div>
							@if($errors->has('category_id'))
								<p class="text-danger">{{ $errors->first('category_id') }}</p>
							@endif
						</div>

						<div class="col-sm-2">
							<button type="submit" class="btn btn-success btn-block btn-icon"><i class="fa fa-save mr-2"></i>Save</button>
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
				$('#username').typeahead({
					onSelect: function(item) {
						document.getElementById("user_id").value = item.value;
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/usernames",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
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