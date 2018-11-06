@extends('layouts.main')
@section('title', 'Add Address')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Add Address</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">User</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account-addressbook') }}">Addressbook</a></li>
			<li class="breadcrumb-item active" aria-current="page">Add Address</li>
		</ol>
	</div>
	<div class="row">
		<form class="col-md-12" role="form" method="post" action="{{ route('account-addressbook-store') }}"> 
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">New Address</h3>
				</div>
				<div class="card-body">
					
					<div class="form-group @if($errors->has('address1')) has-error @endif">
						<label class="form-label">Address</label>
						<input class="form-control" type="text" name="address1" placeholder="Jernbanegata" value="{{ old('address1') }}">
						@if($errors->has('address1'))
							<p class="text-danger">{{ $errors->first('address1') }}</p>
						@endif
					</div>

					<div class="form-group @if($errors->has('address2')) has-error @endif">
						<label class="form-label">Address 2</label>
						<input class="form-control" type="text" name="address2"  placeholder="15D" value="{{ old('address2') }}">
						@if($errors->has('address2'))
							<p class="text-danger">{{ $errors->first('address2') }}</p>
						@endif
					</div>

					<div class="row">
						<div class="col-md-6 form-group @if($errors->has('postalcode')) has-error @endif">
							<label class="form-label">Postal Code</label>
							<input class="form-control" type="text" name="postalcode" placeholder="2609" value="{{ old('postalcode') }}">
							@if($errors->has('postalcode'))
								<p class="text-danger">{{ $errors->first('postalcode') }}</p>
							@endif
						</div>

						<div class="col-md-6 form-group @if($errors->has('city')) has-error @endif">
							<label class="form-label">City</label>
							<input class="form-control" type="text" name="city" placeholder="Lillehammer" value="{{ old('city') }}">
							@if($errors->has('city'))
								<p class="text-danger">{{ $errors->first('city') }}</p>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group @if($errors->has('county')) has-error @endif">
							<label class="form-label">County</label>
							<input class="form-control" type="text" name="county" placeholder="Oppland" value="{{ old('county') }}">
							@if($errors->has('county'))
								<p class="text-danger">{{ $errors->first('county') }}</p>
							@endif
						</div>

						<div class="col-md-6 form-group @if($errors->has('country')) has-error @endif">
							<label class="form-label">Country</label>
							<input class="form-control" type="text" name="country" placeholder="Norway" value="{{ old('country') }}">
							@if($errors->has('country'))
								<p class="text-danger">{{ $errors->first('country') }}</p>
							@endif
						</div>
					</div>
					
				</div>
				<div class="card-footer">
					<label class="custom-switch">
						<input type="checkbox" class="custom-switch-input" name="main_address" @if(old('main_address')) checked @endif>
						<span class="custom-switch-indicator"></span>
						<span class="custom-switch-description">I want this as my primary address</span>
					</label>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Confirm changes with your password</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('password')) has-error @endif">
						<label class="form-label">Password</label>
						<div class="input-group">
							<input class="form-control" type="password" name="password">
						</div>
						@if($errors->has('password'))
							<p class="text-danger">{{ $errors->first('password') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Add Address</button>
				</div>
			</div>
		</form>
	</div>
</div>

@stop