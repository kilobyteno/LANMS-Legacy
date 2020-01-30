@extends('layouts.main')
@section('title', trans('user.addressbook.edit.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('user.addressbook.edit.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account-addressbook') }}">{{ trans('user.addressbook.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('user.addressbook.edit.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<form class="col-md-12" role="form" method="post" action="{{ route('account-addressbook-update', $id) }}"> 
			<div class="card">
				<div class="card-body">
					
					<div class="form-group @if($errors->has('address1')) has-error @endif">
						<label class="form-label">{{ trans('global.address.address1') }}</label>
						<input class="form-control" type="text" name="address1" placeholder="Jernbanegata 15" value="{{ $address1 }}">
						@if($errors->has('address1'))
							<p class="text-danger">{{ $errors->first('address1') }}</p>
						@endif
					</div>

					<div class="form-group @if($errors->has('address2')) has-error @endif">
						<label class="form-label">{{ trans('global.address.address2') }}</label>
						<input class="form-control" type="text" name="address2" value="{{ $address2 }}">
						@if($errors->has('address2'))
							<p class="text-danger">{{ $errors->first('address2') }}</p>
						@endif
					</div>

					<div class="row">
						<div class="col-md-6 form-group @if($errors->has('postalcode')) has-error @endif">
							<label class="form-label">{{ trans('global.address.postalcode') }}</label>
							<input class="form-control" type="text" name="postalcode" placeholder="2609" value="{{ $postalcode }}">
							@if($errors->has('postalcode'))
								<p class="text-danger">{{ $errors->first('postalcode') }}</p>
							@endif
						</div>

						<div class="col-md-6 form-group @if($errors->has('city')) has-error @endif">
							<label class="form-label">{{ trans('global.address.city') }}</label>
							<input class="form-control" type="text" name="city" placeholder="Lillehammer" value="{{ $city }}">
							@if($errors->has('city'))
								<p class="text-danger">{{ $errors->first('city') }}</p>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group @if($errors->has('county')) has-error @endif">
							<label class="form-label">{{ trans('global.address.county') }}</label>
							<input class="form-control" type="text" name="county" placeholder="Oppland" value="{{ $county }}">
							@if($errors->has('county'))
								<p class="text-danger">{{ $errors->first('county') }}</p>
							@endif
						</div>

						<div class="col-md-6 form-group @if($errors->has('country')) has-error @endif">
							<label class="form-label">{{ trans('global.address.country') }}</label>
							<input class="form-control" type="text" name="country" placeholder="Norway" value="{{ $country }}">
							@if($errors->has('country'))
								<p class="text-danger">{{ $errors->first('country') }}</p>
							@endif
						</div>
					</div>

				</div>
				<div class="card-footer">
					<label class="custom-switch">
						<input type="checkbox" class="custom-switch-input" name="main_address" @if($main_address) checked @endif>
						<span class="custom-switch-indicator"></span>
						<span class="custom-switch-description">{{ trans('user.addressbook.primaryaddress') }}</span>
					</label>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('user.addressbook.confirmchanges') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group @if ($errors->has('password')) has-error @endif">
						<label class="form-label">{{ trans('global.password') }}</label>
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
					<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> {{ trans('global.savechanges') }}</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop