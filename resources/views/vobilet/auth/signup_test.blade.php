@extends('layouts.auth')
@section('title', 'Sign Up')

@section('css')
	<!-- forn-wizard css-->
	<link href="{{ Theme::url('plugins/forn-wizard/css/material-bootstrap-wizard.css') }}" rel="stylesheet" />
@stop
   
@section('content')

<div class="container">
	<div class="row">
		<div class="col col-login mx-auto">
			<div class="text-center mb-6">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO_DARK') }}" class="h-6" alt="{{ Setting::get('WEB_NAME') }}"></a>
			</div>
			<form class="card" role="form" method="post" action="{{ route('account-signup-post') }}">
				<div class="card-body p-6">
					<div class="card-title text-center">Create New Account</div>
					@if($errors->any())
						@component('layouts.alert-form')
						    @foreach ($errors->all() as $message)
								<p>{{ $message }}</p>
							@endforeach
						@endcomponent
					@endif
					<div class="wizard-container">
											<div class="wizard-card m-0" data-color="blue" id="wizardProfile">
												<form>
													<div class="wizard-navigation">
														<ul>
															<li><a href="#about" data-toggle="tab">About</a></li>
															<li><a href="#account" data-toggle="tab">Account</a></li>
															<li><a href="#address" data-toggle="tab">Address</a></li>
														</ul>
													</div>

													<div class="tab-content">
														<div class="tab-pane" id="about">
														  <div class="row">
																<div class="col-sm-12">
																	<div class="input-group">
																		
																		<div class="form-group label-floating">
																		  <label class="control-label">First Name <small>(required)</small></label>
																		  <input name="firstname" type="text" class="form-control">
																		</div>
																	</div>

																	<div class="input-group">
																		
																		<div class="form-group label-floating">
																		  <label class="control-label">Last Name <small>(required)</small></label>
																		  <input name="lastname" type="text" class="form-control">
																		</div>
																	</div>
																	<div class="input-group">
																		
																		<div class="form-group label-floating">
																			<label class="control-label">Email <small>(required)</small></label>
																			<input name="email" type="email" class="form-control">
																		</div>
																	</div>
																</div>
																
															</div>
														</div>
														<div class="tab-pane" id="account">
															<h4 class="info-text"> What are you doing? (checkboxes) </h4>
															<div class="row">
																	<div class="col-sm-4">
																		<div class="choice" data-toggle="wizard-checkbox">
																			<input type="checkbox" name="jobb" value="Design">
																			<div class="icon">
																				<i class="fa fa-pencil"></i>
																			</div>
																			<h6>Design</h6>
																		</div>
																	</div>
																	<div class="col-sm-4">
																		<div class="choice" data-toggle="wizard-checkbox">
																			<input type="checkbox" name="jobb" value="Code">
																			<div class="icon">
																				<i class="fa fa-terminal"></i>
																			</div>
																			<h6>Code</h6>
																		</div>
																	</div>
																	<div class="col-sm-4">
																		<div class="choice" data-toggle="wizard-checkbox">
																			<input type="checkbox" name="jobb" value="Develop">
																			<div class="icon">
																				<i class="fa fa-laptop"></i>
																			</div>
																			<h6>Develop</h6>
																		</div>
																	</div>
															</div>
														</div>
														<div class="tab-pane" id="address">
															<div class="row">
																<div class="col-sm-12">
																	<h4 class="info-text"> Are you living in a nice area? </h4>
																</div>
																<div class="col-sm-8 ">
																	<div class="form-group label-floating">
																		<label class="control-label">Street Name</label>
																		<input type="text" class="form-control">
																	</div>
																</div>
																<div class="col-sm-4">
																	<div class="form-group label-floating">
																		<label class="control-label">Street Number</label>
																		<input type="text" class="form-control">
																	</div>
																</div>
																<div class="col-sm-6 ">
																	<div class="form-group label-floating">
																		<label class="control-label">City</label>
																		<input type="text" class="form-control">
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group label-floating">
																		<label class="control-label">Country</label>
																		<select name="country" class="form-control">
																			<option disabled="" value="..." selected="">select</option>
																			<option value="Afghanistan"> Afghanistan </option>
																			<option value="Albania"> Albania </option>
																			<option value="Algeria"> Algeria </option>
																			<option value="American Samoa"> American Samoa </option>
																			<option value="Andorra"> Andorra </option>
																			<option value="Angola"> Angola </option>
																			<option value="Anguilla"> Anguilla </option>
																			<option value="Antarctica"> Antarctica </option>
																			<option value="...">...</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wizard-footer">
														<div class="pull-right">
															<input type='button' class='btn btn-next btn-fill btn-primary btn-wd m-0' name='next' value='Next' />
															<input type='button' class='btn btn-finish btn-fill btn-success btn-wd m-0' name='finish' value='Finish' />
														</div>

														<div class="pull-left">
															<input type='button' class='btn btn-previous btn-fill btn-default btn-wd m-0' name='previous' value='Previous' />
														</div>
														<div class="clearfix"></div>
													</div>
												</form>
											</div>
										</div> <!-- wizard container -->
					<hr>
					<div class="text-center text-muted mt-3">
						Already have account? <a href="{{ route('account-signin') }}">Sign in</a>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>

@stop

@section('javascript')

	<!-- forn-wizard js-->
	<script src="{{ Theme::url('plugins/forn-wizard/js/material-bootstrap-wizard.js') }}"></script>
	<script src="{{ Theme::url('plugins/forn-wizard/js/jquery.validate.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/forn-wizard/js/jquery.bootstrap.js') }}"></script>

@stop