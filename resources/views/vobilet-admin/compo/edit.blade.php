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
		
		<form class="card" action="{{ route('admin-compo-update', $compo->id) }}" method="post">
			<div class="card-header">
				<div class="card-options">
					<button class="btn btn-sm btn-success" type="submit"><i class="fas fa-save mr-2"></i> Save</button>
				</div>
			</div>
			<div class="card-body">

				<div class="panel panel-primary">
					<div class="tab-menu-heading">
						<div class="tabs-menu">
							<!-- Tabs -->
							<ul class="nav panel-tabs">
								<li><a href="#tab1" class="active" data-toggle="tab">General</a></li>
								<li><a href="#tab2" data-toggle="tab">Challonge</a></li>
								<li><a href="#tab3" data-toggle="tab">Toornament</a></li>
								<li><a href="#tab4" data-toggle="tab">Prizepool</a></li>
								<li><a href="#tab5" data-toggle="tab">Date & Time</a></li>
							</ul>
						</div>
					</div>
					<div class="panel-body tabs-menu-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">

								<div class="form-row">
									<div class="col-xl-12">
										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text">Compo Name</span>
											</span>
											<input type="text" class="form-control input-lg {{ ($errors->has('name')) ? 'is-invalid state-invalid' : '' }}" name="name" autocomplete="off" placeholder="Name" value="{{ (old('name')) ? old('name') : $compo->name }}" />
											@if($errors->has('name'))
												<div class="invalid-feedback">{{ $errors->first('name') }}</div>
											@endif
										</div>
									</div>
								</div>

								<div class="form-row mt-5">
									
									<div class="col-xl-12">
										<div class="form-group">
											<label class="form-label">Description:</label>
											<textarea class="form-control input-lg {{ ($errors->has('description')) ? 'is-invalid state-invalid' : '' }}" name="description" autocomplete="off" placeholder="Description">{{ (old('description')) ? old('description') : $compo->description }}</textarea>
											@if($errors->has('description'))
												<div class="invalid-feedback">{{ $errors->first('description') }}</div>
											@endif
										</div>
									</div>

								</div>

								<div class="form-row mt-5">
									
									<div class="col-xl-4">
										<div class="input-group">
											<label class="form-label">Type:</label>
											<select name="type" class="select2 {{ ($errors->has('type')) ? 'is-invalid state-invalid' : '' }}">
												<option value="1" {{ ($compo->type == 1) ? 'selected' : '' }}>Brackets</option>
												<option value="2" {{ ($compo->type == 2) ? 'selected' : '' }}>Submissions</option>
											</select>
											@if($errors->has('type'))
												<div class="invalid-feedback">{{ $errors->first('type') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-4">
										<div class="input-group">
											<label class="form-label">Signup Type:</label>
											<select name="signup_type" id="signup_type" class="select2 {{ ($errors->has('signup_type')) ? 'is-invalid state-invalid' : '' }}">
												<option value="1" {{ ($compo->signup_type == 1) ? 'selected' : '' }}>Team</option>
												<option value="2" {{ ($compo->signup_type == 2) ? 'selected' : '' }}>Individual</option>
											</select>
											@if($errors->has('signup_type'))
												<div class="invalid-feedback">{{ $errors->first('signup_type') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-4">
										<div class="form-group">
											<label class="form-label">Rules Page:</label>
											<select name="page_id" id="page_id" class="select2 {{ ($errors->has('signup_size')) ? 'is-invalid state-invalid' : '' }}">
												<option value="">--- {{ trans('global.pleaseselect') }} ---</option>
												@foreach(\LANMS\Page::all() as $page)
													<option value="{{ $page->id }}" {{ ($compo->page_id == $page->id) ? 'selected' : '' }}>{{ $page->title }}</option>
												@endforeach
											</select>
											@if($errors->has('page_id'))
												<div class="invalid-feedback">{{ $errors->first('page_id') }}</div>
											@endif
										</div>
									</div>

								</div>

								<div class="form-row mt-5">

									<div class="col-xl-4">
										<div class="form-group">
											<label class="form-label">Signup Size:</label>
											<input type="number" class="form-control {{ ($errors->has('signup_size')) ? 'is-invalid state-invalid' : '' }}" name="signup_size" id="signup_size" value="{{ (old('signup_size')) ? old('signup_size') : $compo->signup_size }}">
											@if($errors->has('signup_size'))
												<div class="invalid-feedback">{{ $errors->first('signup_size') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-4">
										<div class="form-group">
											<label class="form-label">Min signups: <small>Minimum amount of teams/individuals for compo to start (0 = unlimited)</small></label>
											<input type="number" class="form-control {{ ($errors->has('min_signups')) ? 'is-invalid state-invalid' : '' }}" name="min_signups" value="{{ (old('min_signups')) ? old('min_signups') : $compo->min_signups }}">
											@if($errors->has('min_signups'))
												<div class="invalid-feedback">{{ $errors->first('min_signups') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-4">
										<div class="form-group">
											<label class="form-label">Max signups: <small>Max amount of teams/individuals allowed to sign up (0 = unlimited)</small></label>
											<input type="number" class="form-control {{ ($errors->has('max_signups')) ? 'is-invalid state-invalid' : '' }}" name="max_signups" value="{{ (old('max_signups')) ? old('max_signups') : $compo->max_signups }}">
											@if($errors->has('max_signups'))
												<div class="invalid-feedback">{{ $errors->first('max_signups') }}</div>
											@endif
										</div>
									</div>
									
								</div>

							</div>

							<div class="tab-pane" id="tab2">

								<div class="form-row">
					
									<div class="col-xl-6">
										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text">Challonge Subdomain</span>
											</span>
											<input type="text" class="form-control input-lg {{ ($errors->has('challonge_subdomain')) ? 'is-invalid state-invalid' : '' }}" name="challonge_subdomain" autocomplete="off" placeholder="Challonge Subdomain" value="{{ (old('challonge_subdomain')) ? old('challonge_subdomain') : $compo->challonge_subdomain }}" />
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
											<input type="text" class="form-control input-lg {{ ($errors->has('challonge_url')) ? 'is-invalid state-invalid' : '' }}" name="challonge_url" autocomplete="off" placeholder="Challonge URL" value="{{ (old('challonge_url')) ? old('challonge_url') : $compo->challonge_url }}" />
											@if($errors->has('challonge_url'))
												<div class="invalid-feedback">{{ $errors->first('challonge_url') }}</div>
											@endif
										</div>
									</div>
									
								</div>

							</div>

							<div class="tab-pane" id="tab3">

								<div class="form-row">
					
									<div class="col-xl-6">
										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text">Toornament ID</span>
											</span>
											<input type="text" class="form-control input-lg {{ ($errors->has('toornament_id')) ? 'is-invalid state-invalid' : '' }}" name="toornament_id" autocomplete="off" placeholder="Toornament ID" value="{{ (old('toornament_id')) ? old('toornament_id') : $compo->toornament_id }}" />
											@if($errors->has('toornament_id'))
												<div class="invalid-feedback">{{ $errors->first('toornament_id') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-6">
										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text">Toornament Stage ID</span>
											</span>
											<input type="text" class="form-control input-lg {{ ($errors->has('toornament_stage_id')) ? 'is-invalid state-invalid' : '' }}" name="toornament_stage_id" autocomplete="off" placeholder="Toornament Stage ID" value="{{ (old('toornament_stage_id')) ? old('toornament_stage_id') : $compo->toornament_stage_id }}" />
											@if($errors->has('toornament_stage_id'))
												<div class="invalid-feedback">{{ $errors->first('toornament_stage_id') }}</div>
											@endif
										</div>
										<p class="text-center m-5"><em>~ or ~</em></p>
										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text">Toornament Match ID</span>
											</span>
											<input type="text" class="form-control input-lg {{ ($errors->has('toornament_match_id')) ? 'is-invalid state-invalid' : '' }}" name="toornament_match_id" autocomplete="off" placeholder="Toornament Match ID" value="{{ (old('toornament_match_id')) ? old('toornament_match_id') : $compo->toornament_match_id }}" />
											@if($errors->has('toornament_match_id'))
												<div class="invalid-feedback">{{ $errors->first('toornament_match_id') }}</div>
											@endif
										</div>
									</div>
									
								</div>

								<p class="mt-5">Referer to this page for more info: <a href="https://help.toornament.com/share/the-widgets#the_stage_widget" target="_blank">https://help.toornament.com/share/the-widgets#the_stage_widget</a></p>
								
							</div>

							<div class="tab-pane" id="tab4">

								<div class="form-row">
									
									<div class="col-xl-3">
										<div class="form-group">
											<label class="form-label">Prize Pool Total: <small>Example: 10000</small></label>
											<input type="number" class="form-control {{ ($errors->has('prize_pool_total')) ? 'is-invalid state-invalid' : '' }}" name="prize_pool_total" value="{{ (old('prize_pool_total')) ? old('prize_pool_total') : $compo->prize_pool_total }}">
											@if($errors->has('prize_pool_total'))
												<div class="invalid-feedback">{{ $errors->first('prize_pool_total') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-3">
										<div class="form-group">
											<label class="form-label">Prize Pool First:</label>
											<input type="text" class="form-control input-lg {{ ($errors->has('prize_pool_first')) ? 'is-invalid state-invalid' : '' }}" name="prize_pool_first" autocomplete="off" placeholder="5000kr + 2 tickets" value="{{ (old('prize_pool_first')) ? old('prize_pool_first') : $compo->prize_pool_first }}" />
											@if($errors->has('prize_pool_first'))
												<div class="invalid-feedback">{{ $errors->first('prize_pool_first') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-3">
										<div class="form-group">
											<label class="form-label">Prize Pool Second:</label>
											<input type="text" class="form-control input-lg {{ ($errors->has('prize_pool_second')) ? 'is-invalid state-invalid' : '' }}" name="prize_pool_second" autocomplete="off" placeholder="3000kr + 2 sodas" value="{{ (old('prize_pool_second')) ? old('prize_pool_second') : $compo->prize_pool_second }}" />
											@if($errors->has('prize_pool_second'))
												<div class="invalid-feedback">{{ $errors->first('prize_pool_second') }}</div>
											@endif
										</div>
									</div>

									<div class="col-xl-3">
										<div class="form-group">
											<label class="form-label">Prize Pool Third:</label>
											<input type="text" class="form-control input-lg {{ ($errors->has('prize_pool_third')) ? 'is-invalid state-invalid' : '' }}" name="prize_pool_third" autocomplete="off" placeholder="2000kr" value="{{ (old('prize_pool_third')) ? old('prize_pool_third') : $compo->prize_pool_third }}" />
											@if($errors->has('prize_pool_third'))
												<div class="invalid-feedback">{{ $errors->first('prize_pool_third') }}</div>
											@endif
										</div>
									</div>
									
								</div>

							</div>

							<div class="tab-pane" id="tab5">

								<div class="form-row">
										
									<div class="col-6">
										<div class="form-row">
											<div class="col-xl-6">
												<p>Start Date</p>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar"></i>
														</div>
													</div>
													<input class="form-control datepicker {{ ($errors->has('start_at_date')) ? 'is-invalid state-invalid' : '' }}" name="start_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('start_at_date')) ? old('start_at_date') : Carbon::parse($compo->start_at)->isoFormat('YYYY-MM-DD') }}">
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
													<input class="form-control ui-timepicker-input {{ ($errors->has('start_at_time')) ? 'is-invalid state-invalid' : '' }}" id="start_at_time" placeholder="Set time" type="text" autocomplete="off" name="start_at_time" value="{{ (old('start_at_time')) ? old('start_at_time') : Carbon::parse($compo->start_at)->isoFormat('HH:mm') }}">
													@if($errors->has('start_at_time'))
														<div class="invalid-feedback">{{ $errors->first('start_at_time') }}</div>
													@endif
												</div>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="form-row">
											<div class="col-xl-6">
												<p>End Date</p>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar"></i>
														</div>
													</div>
													<input class="form-control datepicker {{ ($errors->has('end_at_date')) ? 'is-invalid state-invalid' : '' }}" name="end_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('end_at_date')) ? old('end_at_date') : Carbon::parse($compo->end_at)->isoFormat('YYYY-MM-DD') }}">
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
													<input class="form-control ui-timepicker-input {{ ($errors->has('end_at_time')) ? 'is-invalid state-invalid' : '' }}" id="end_at_time" placeholder="Set time" type="text" autocomplete="off" name="end_at_time" value="{{ (old('end_at_time')) ? old('end_at_time') : Carbon::parse($compo->end_at)->isoFormat('HH:mm') }}">
													@if($errors->has('end_at_time'))
														<div class="invalid-feedback">{{ $errors->first('end_at_time') }}</div>
													@endif
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="form-row mt-5">

									<div class="col-6">
										<div class="form-row">
											<div class="col-xl-6">
												<p>First Sign Up Date</p>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar"></i>
														</div>
													</div>
													<input class="form-control datepicker {{ ($errors->has('first_sign_up_at_date')) ? 'is-invalid state-invalid' : '' }}" name="first_sign_up_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('first_sign_up_at_date')) ? old('first_sign_up_at_date') : Carbon::parse($compo->first_sign_up_at)->isoFormat('YYYY-MM-DD') }}">
													@if($errors->has('first_sign_up_at_date'))
														<div class="invalid-feedback">{{ $errors->first('first_sign_up_at_date') }}</div>
													@endif
												</div>
											</div>
											<div class="col-xl-6">
												<p>First Sign Up Time</p>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-clock"></i>
														</div>
													</div>
													<input class="form-control ui-timepicker-input {{ ($errors->has('first_sign_up_at_time')) ? 'is-invalid state-invalid' : '' }}" id="first_sign_up_at_time" placeholder="Set time" type="text" autocomplete="off" name="first_sign_up_at_time" value="{{ (old('first_sign_up_at_time')) ? old('first_sign_up_at_time') : Carbon::parse($compo->first_sign_up_at)->isoFormat('HH:mm') }}">
													@if($errors->has('first_sign_up_at_time'))
														<div class="invalid-feedback">{{ $errors->first('first_sign_up_at_time') }}</div>
													@endif
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-6">
										<div class="form-row">
											<div class="col-xl-6">
												<p>Last Sign Up Date</p>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar"></i>
														</div>
													</div>
													<input class="form-control datepicker {{ ($errors->has('last_sign_up_at_date')) ? 'is-invalid state-invalid' : '' }}" name="last_sign_up_at_date" type="text" data-date-format="yyyy-mm-dd" value="{{ (old('last_sign_up_at_date')) ? old('last_sign_up_at_date') : Carbon::parse($compo->last_sign_up_at)->isoFormat('YYYY-MM-DD') }}">
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
													<input class="form-control ui-timepicker-input {{ ($errors->has('last_sign_up_at_time')) ? 'is-invalid state-invalid' : '' }}" id="last_sign_up_at_time" placeholder="Set time" type="text" autocomplete="off" name="last_sign_up_at_time" value="{{ (old('last_sign_up_at_time')) ? old('last_sign_up_at_time') : Carbon::parse($compo->last_sign_up_at)->isoFormat('HH:mm') }}">
													@if($errors->has('last_sign_up_at_time'))
														<div class="invalid-feedback">{{ $errors->first('last_sign_up_at_time') }}</div>
													@endif
												</div>
											</div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">

			</div>
		</form>

		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Signups
				</div>
			</div>
			<div class="card-body">
				@foreach($compo->signupsthisYear as $signup)
					@if($signup->team_id)
						<div class="col-lg-3 mb-5">
							<h5><strong>{{ $signup->team->name }}</strong></h5>
							<p class="m-0"><i class="fas fa-user mr-2"></i>{{ \LANMS\User::getFullnameAndNicknameByID($signup->team->user_id) }}</p>
							@foreach($signup->team->players as $player)
								<p class="m-0"><i class="far fa-user mr-2"></i>{{ \LANMS\User::getFullnameAndNicknameByID($player->id) }}</p>
							@endforeach
						</div>
					@elseif(!$signup->team_id && $signup->user_id)
						<div class="col-lg-3 mb-4">{{ \LANMS\User::getFullnameAndNicknameByID($signup->user_id) }}</div>
					@endif
				@endforeach
			</div>
		</div>

	</div>
</div>

@stop
@section('css')
	<link href="{{ Theme::url('plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('js/vendors/bootstrap-datepicker3.standalone.css') }}" rel="stylesheet">
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
		    $('#first_sign_up_at_time').timepicker({
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