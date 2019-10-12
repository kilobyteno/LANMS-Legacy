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
	<div class="col-xl-12">

		<form class="card" action="{{ route('admin-compo-store') }}" method="post">
			<div class="card-header">
				<div class="card-options">
					<button class="btn btn-sm btn-success" type="submit"><i class="fas fa-save mr-2"></i> Save</button>
				</div>
			</div>
			<div class="card-body">

				<div class="form-row">
					
					<div class="col-xl-12">
						<div class="input-group">
							<input type="text" class="form-control input-lg {{ ($errors->has('name')) ? 'is-invalid' : '' }}" name="name" autocomplete="off" placeholder="Name" value="{{ (old('name')) ? old('name') : '' }}" />
							@if($errors->has('name'))
								<div class="invalid-feedback">{{ $errors->first('name') }}</div>
							@endif
						</div>
					</div>

				</div>

				<div class="form-row mt-5">
					
					<div class="col-xl-6">
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="input-group-text">Challonge Subdomain</span>
							</span>
							<input type="text" class="form-control input-lg {{ ($errors->has('challonge_subdomain')) ? 'is-invalid' : '' }}" name="challonge_subdomain" autocomplete="off" placeholder="Challonge Subdomain" value="{{ (old('challonge_subdomain')) ? old('challonge_subdomain') : '' }}" />
							@if($errors->has('challonge_subdomain'))
								<div class="invalid-feedback">{{ $errors->first('challonge_subdomain') }}</div>
							@endif
						</div>
					</div>

					<div class="col-xl-6">
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="input-group-text">Challonge URL</span>
							</span>
							<input type="text" class="form-control input-lg {{ ($errors->has('challonge_url')) ? 'is-invalid' : '' }}" name="challonge_url" autocomplete="off" placeholder="Challonge URL" value="{{ (old('challonge_url')) ? old('challonge_url') : '' }}" />
							@if($errors->has('challonge_url'))
								<div class="invalid-feedback">{{ $errors->first('challonge_url') }}</div>
							@endif
						</div>
					</div>
					
				</div>

				<div class="form-row mt-5">
					
					<div class="col-xl-3">
						<div class="input-group">
							<label class="form-label">Type:</label>
							<select name="type" class="select2">
								<option value="1" selected="">Brackets</option>
								<option value="2">Submissions</option>
							</select>
							@if($errors->has('type'))
								<div class="invalid-feedback">{{ $errors->first('type') }}</div>
							@endif
						</div>
					</div>

					<div class="col-xl-3">
						<div class="input-group">
							<label class="form-label">Signup Type:</label>
							<select name="signup_type" id="signup_type" class="select2">
								<option value="1" selected="">Team</option>
								<option value="2">Individual</option>
							</select>
							@if($errors->has('signup_type'))
								<div class="invalid-feedback">{{ $errors->first('signup_type') }}</div>
							@endif
						</div>
					</div>

					<div class="col-xl-3">
						<div class="form-group">
							<label class="form-label">Signup Size:</label>
							<input type="number" class="form-control {{ ($errors->has('signup_size')) ? 'is-invalid' : '' }}" name="signup_size" id="signup_size">
							@if($errors->has('signup_size'))
								<div class="invalid-feedback">{{ $errors->first('signup_size') }}</div>
							@endif
						</div>
					</div>

					<div class="col-xl-3">
						<div class="form-group">
							<label class="form-label">Rules Page:</label>
							<select name="page_id" id="page_id" class="select2">
								<option value="">--- {{ trans('global.pleaseselect') }} ---</option>
								@foreach(\LANMS\Page::all() as $page)
									<option value="{{ $page->id }}">{{ $page->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
				</div>

				<div class="form-row mt-5">
					
					<div class="col-xl-4">
						<div class="form-row">
							<div class="col-xl-6">
								<p>Start Date</p>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-calendar"></i>
										</div>
									</div>
									<input class="form-control datepicker" name="start_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('start_at_date')) ? old('start_at_date') : Carbon::now()->isoFormat('YYYY-MM-DD') }}">
									@if($errors->has('start_at_date'))
										<div class="invalid-feedback">{{ $errors->first('start_at_date') }}</div>
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
									<input class="form-control ui-timepicker-input @if($errors->has('start_at_time')) is-invalid state-invalid @endif" id="start_at_time" placeholder="Set time" type="text" autocomplete="off" name="start_at_time" value="{{ (old('start_at_time')) ? old('start_at_time') : Carbon::now()->isoFormat('HH:mm') }}">
									@if($errors->has('start_at_time'))
										<div class="invalid-feedback">{{ $errors->first('start_at_time') }}</div>
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4">
						<div class="form-row">
							<div class="col-xl-6">
								<p>Last Sign Up Date</p>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-calendar"></i>
										</div>
									</div>
									<input class="form-control datepicker" name="last_sign_up_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('last_sign_up_at_date')) ? old('last_sign_up_at_date') : Carbon::now()->isoFormat('YYYY-MM-DD') }}">
									@if($errors->has('last_sign_up_at_date'))
										<div class="invalid-feedback">{{ $errors->first('last_sign_up_at_date') }}</div>
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
									<input class="form-control ui-timepicker-input @if($errors->has('last_sign_up_at_time')) is-invalid state-invalid @endif" id="last_sign_up_at_time" placeholder="Set time" type="text" autocomplete="off" name="last_sign_up_at_time" value="{{ (old('last_sign_up_at_time')) ? old('last_sign_up_at_time') : Carbon::now()->isoFormat('HH:mm') }}">
									@if($errors->has('last_sign_up_at_time'))
										<div class="invalid-feedback">{{ $errors->first('last_sign_up_at_time') }}</div>
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4">
						<div class="form-row">
							<div class="col-xl-6">
								<p>End Date</p>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-calendar"></i>
										</div>
									</div>
									<input class="form-control datepicker" name="end_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('end_at_date')) ? old('end_at_date') : Carbon::now()->isoFormat('YYYY-MM-DD') }}">
									@if($errors->has('end_at_date'))
										<div class="invalid-feedback">{{ $errors->first('end_at_date') }}</div>
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
									<input class="form-control ui-timepicker-input @if($errors->has('end_at_time')) is-invalid state-invalid @endif" id="end_at_time" placeholder="Set time" type="text" autocomplete="off" name="end_at_time" value="{{ (old('end_at_time')) ? old('end_at_time') : Carbon::now()->isoFormat('HH:mm') }}">
									@if($errors->has('end_at_time'))
										<div class="invalid-feedback">{{ $errors->first('end_at_time') }}</div>
									@endif
								</div>
							</div>
						</div>
					</div>
					
				</div>

				<div class="form-row mt-5">
					
					<div class="col-xl-12">
						<div class="form-group">
							<label class="form-label">Description:</label>
							<textarea class="form-control input-lg {{ ($errors->has('description')) ? 'is-invalid' : '' }}" name="description" autocomplete="off" placeholder="Description">{{ (old('description')) ? old('description') : '' }}</textarea>
							@if($errors->has('description'))
								<div class="invalid-feedback">{{ $errors->first('description') }}</div>
							@endif
						</div>
					</div>

				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">

			</div>
		</form>
		
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