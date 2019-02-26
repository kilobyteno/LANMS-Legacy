@extends('layouts.main')
@section('title', 'Edit Compo - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Compo</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-compo') }}">Compo</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Compo</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-compo-update', $compo->id) }}" method="post">

					<div class="row">
						
						<div class="col-xl-12">
							<div class="input-group">
								<input type="text" class="form-control input-lg" name="name" autocomplete="off" placeholder="Title" value="{{ (old('name')) ? old('name') : $compo->name }}" />
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
								<input type="text" class="form-control input-lg" name="challonge_subdomain" autocomplete="off" placeholder="Challonge Subdomain" value="{{ (old('challonge_subdomain')) ? old('challonge_subdomain') : $compo->challonge_subdomain }}" />
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
								<input type="text" class="form-control input-lg" name="challonge_url" autocomplete="off" placeholder="Challonge URL" value="{{ (old('challonge_url')) ? old('challonge_url') : $compo->challonge_url }}" />
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
									<option value="1" @if($compo->type == 1) selected="" @endif>Brackets</option>
									<option value="2" @if($compo->type == 2) selected="" @endif>Submissions</option>
								</select>
							</div>
						</div>

						<div class="col-xl-3">
							<div class="input-group">
								<label class="form-label">Signup Type:</label>
								<select name="signup_type" id="signup_type" class="select2">
									<option value="1" @if($compo->type == 1) selected="" @endif>Team</option>
									<option value="2" @if($compo->type == 2) selected="" @endif>Individual</option>
								</select>
							</div>
						</div>

						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label">Signup Size:</label>
								<input type="number" class="form-control" name="signup_size" id="signup_size" value="{{ (old('signup_size')) ? old('signup_size') : $compo->signup_size }}">
							</div>
						</div>

						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label">Rules Page:</label>
								<select name="page_id" id="page_id" class="select2">
									<option>--- {{ trans('global.pleaseselect') }} ---</option>
									@foreach(\LANMS\Page::all() as $page)
										<option value="{{ $page->id }}" @if($compo->page_id == $page->id) selected="" @endif>{{ $page->title }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
					</div>

					<div class="row mt-5">
						
						<div class="col-xl-4">
							<div class="row">
								<div class="col-xl-6">
									<p>Start Date</p>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fa fa-calendar"></i>
											</div>
										</div>
										<input class="form-control datepicker" name="start_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('start_at_date')) ? old('start_at_date') : date('Y-m-d', strtotime($compo->start_at)) }}">
										@if($errors->has('start_at_date'))
											<p class="text-danger">{{ $errors->first('start_at_date') }}</p>
										@endif
									</div>
								</div>
								<div class="col-xl-6">
									<p>Start Time</p>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-clock"></i>
											</div>
										</div>
										<input class="form-control ui-timepicker-input @if($errors->has('start_at_time')) is-invalid state-invalid @endif" id="start_at_time" placeholder="Set time" type="text" autocomplete="off" name="start_at_time" value="{{ (old('start_at_time')) ? old('start_at_time') : date('H:i', strtotime($compo->start_at)) }}">
										@if($errors->has('start_at_time'))
											<p class="text-danger">{{ $errors->first('start_at_time') }}</p>
										@endif
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4">
							<div class="row">
								<div class="col-xl-6">
									<p>Last Sign Up Date</p>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fa fa-calendar"></i>
											</div>
										</div>
										<input class="form-control datepicker" name="last_sign_up_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('last_sign_up_at_date')) ? old('last_sign_up_at_date') : date('Y-m-d', strtotime($compo->last_sign_up_at)) }}">
										@if($errors->has('last_sign_up_at_date'))
											<p class="text-danger">{{ $errors->first('last_sign_up_at_date') }}</p>
										@endif
									</div>
								</div>
								<div class="col-xl-6">
									<p>Last Sign Up Time</p>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-clock"></i>
											</div>
										</div>
										<input class="form-control ui-timepicker-input @if($errors->has('last_sign_up_at_time')) is-invalid state-invalid @endif" id="last_sign_up_at_time" placeholder="Set time" type="text" autocomplete="off" name="last_sign_up_at_time" value="{{ (old('last_sign_up_at_time')) ? old('last_sign_up_at_time') : date('H:i', strtotime($compo->last_sign_up_at)) }}">
										@if($errors->has('last_sign_up_at_time'))
											<p class="text-danger">{{ $errors->first('last_sign_up_at_time') }}</p>
										@endif
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4">
							<div class="row">
								<div class="col-xl-6">
									<p>End Date</p>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fa fa-calendar"></i>
											</div>
										</div>
										<input class="form-control datepicker" name="end_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('end_at_date')) ? old('end_at_date') : date('Y-m-d', strtotime($compo->end_at)) }}">
										@if($errors->has('end_at_date'))
											<p class="text-danger">{{ $errors->first('end_at_date') }}</p>
										@endif
									</div>
								</div>
								<div class="col-xl-6">
									<p>End Time</p>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-clock"></i>
											</div>
										</div>
										<input class="form-control ui-timepicker-input @if($errors->has('end_at_time')) is-invalid state-invalid @endif" id="end_at_time" placeholder="Set time" type="text" autocomplete="off" name="end_at_time" value="{{ (old('end_at_time')) ? old('end_at_time') : date('H:i', strtotime($compo->end_at)) }}">
										@if($errors->has('end_at_time'))
											<p class="text-danger">{{ $errors->first('end_at_time') }}</p>
										@endif
									</div>
								</div>
							</div>
						</div>
						
					</div>

					<div class="row mt-5">
						
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label">Description:</label>
								<textarea class="form-control input-lg" name="description" autocomplete="off" placeholder="Description">{{ (old('description')) ? old('description') : $compo->description }}</textarea>
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
@section('css')
	<link href="{{ Theme::url('plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('js/vendors/bootstrap-datepicker3.standalone.css') }} rel="stylesheet">
@stop
@section('javascript')
	<script type="text/javascript">
		$(function(){
			@if($compo->type == 1)
				$('#signup_size').attr({
					"min" : 1,
					"max" : 10,
				});
				$('#signup_size').val({{ $compo->signup_size ?? '1'}});
			@elseif($compo->type == 2)
				$('#signup_size').attr({
					"min" : 1,
					"max" : 1,
				});
				$('#signup_size').val({{ $compo->signup_size ?? '1'}});
			@endif
			$('.select2').select2({minimumResultsForSearch:-1});
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

	<script src="{{ Theme::url('js/vendors/bootstrap-datepicker.js') }}"></script>

	<!-- Time -->
	<script src="{{ Theme::url('plugins/time-picker/jquery.timepicker.js') }}"></script>

	<!-- maskedinput -->
	<script src="{{ Theme::url('plugins/input-mask/jquery.maskedinput.js') }}"></script>

	<!-- Activations -->
	<script type="text/javascript">
		$(function(){
		    $('#start_at_time').timepicker({
		    	'scrollDefault': 'now',
		    	'timeFormat': 'H:i',
		    	'step': 15
		    });
		    $('#last_sign_up_at_time').timepicker({
		    	'scrollDefault': 'now',
		    	'timeFormat': 'H:i',
		    	'step': 15
		    });
		    $('#end_at_time').timepicker({
		    	'scrollDefault': 'now',
		    	'timeFormat': 'H:i',
		    	'step': 15
		    });
		    $('.select2').select2();
		    $('.datepicker').datepicker({
		    	format: 'yyyy-mm-dd',
		    	todayBtn: "linked",
			    calendarWeeks: true,
			    autoclose: true,
			    todayHighlight: true
		    });
		});
	</script>
@stop