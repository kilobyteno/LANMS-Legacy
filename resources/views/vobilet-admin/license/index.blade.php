@extends('layouts.main')
@section('title', 'License Status - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">License Status</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">License Status</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">

		<div class="row">
			<div class="col-md-6">
				<div class="expanel expanel-primary @if(Setting::get('APP_LICENSE_STATUS') == 'Active') expanel-success @else expanel-danger @endif" data-collapsed="0">
					<div class="expanel-heading">
						<div class="expanel-title">Status</div>
					</div>
					<div class="expanel-body">
						<p>Status: @if(Setting::get('APP_LICENSE_STATUS') == 'Active') <strong class="text-success">{{ Setting::get('APP_LICENSE_STATUS') }}</strong> @else <strong class="text-danger">{{ Setting::get('APP_LICENSE_STATUS') }}</strong> @endif</p>
						<p>@if(Setting::get('APP_LICENSE_STATUS_DESC') != "")Description: <em>{{ Setting::get('APP_LICENSE_STATUS_DESC') }}</em>@endif</p>
						<a href="{{ route('admin-license-check') }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-sync"></i> Check License Status</a>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="expanel expanel-primary @if($errors->has('APP_LICENSE_KEY')) expanel-danger @endif" data-collapsed="0">
					<div class="expanel-heading">
						<div class="expanel-title">Update License Key</div>
					</div>
					<div class="expanel-body">
						<form action="{{ route('admin-license-store') }}" method="post">
							<div class="input-group">
								<input type="text" class="form-control input-lg" name="licensekey" placeholder="LANMS-XXX-XXXXXXXXXXXXXX" value="{{ (old('licensekey')) ? old('licensekey') : Setting::get('APP_LICENSE_KEY') }}" />
								<span class="input-group-append">
									<button type="submit" class="btn btn-lg btn-success btn-icon mr-2"><i class="fa fa-save"></i> Save</button>
								</span>
							</div>
							@if($errors->has('licensekey'))
								<p class="text-danger">{{ $errors->first('licensekey') }}</p>
							@endif
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@stop