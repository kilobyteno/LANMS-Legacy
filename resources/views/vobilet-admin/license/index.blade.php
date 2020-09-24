@extends('layouts.main')
@section('title', 'License - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">License</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">License</li>
	</ol>
</div>

<div class="row">
	<div class="col-sm-12 col-xl-4 col-md-6 col-lg-6">

		<div class="card">
			<div class="card-header @if(Setting::get('APP_LICENSE_STATUS') == 'Active') bg-success @else bg-danger @endif">
				<h3 class="card-title text-white">@if(Setting::get('APP_LICENSE_STATUS') == 'Active') <i class="fas fa-clipboard-check"></i> @else <i class="fas fa-exclamation-triangle"></i> @endif{{ Setting::get('APP_LICENSE_STATUS') }}</h3>
				<div class="card-options">
					<a href="{{ route('admin-license-check') }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i> Check License</a>
				</div>
			</div>
			<div class="card-body">
				@if(Setting::get('APP_LICENSE_STATUS_DESC') != "")<p>Description: <em>{{ Setting::get('APP_LICENSE_STATUS_DESC') }}</em></p>@endif
				@if(Setting::get('APP_LICENSE_LAST_CHECKED') != "")<p>Last checked: <em>{{ Setting::get('APP_LICENSE_LAST_CHECKED') }}</em></p>@endif
				<form action="{{ route('admin-license-store') }}" method="post">
					<div class="input-group">
						<input type="text" class="form-control" name="licensekey" placeholder="LANMS-XXX-XXXXXXXXXXXXXX" value="{{ (old('licensekey')) ? old('licensekey') : Setting::get('APP_LICENSE_KEY') }}" />
						<span class="input-group-append">
							<button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Save</button>
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
	<div class="col-sm-12 col-xl-4 col-md-6 col-lg-6">

		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><i class="far fa-id-card"></i> License Holder</h3>
			</div>
			<div class="card-body">
				<p>Name: <em>{{ Setting::get('APP_LICENSE_INFO_NAME') }}</em></p>
				<p>Company: <em>{{ Setting::get('APP_LICENSE_INFO_COMPANY') }}</em></p>
				<p>Email: <em>{{ Setting::get('APP_LICENSE_INFO_EMAIL') }}</em></p>
				<p>Productname: <em>{{ Setting::get('APP_LICENSE_INFO_PRODUCTNAME') }}</em></p>
				<p>Registered: <em>{{ Setting::get('APP_LICENSE_INFO_REGDATE') ? \Carbon::parse(Setting::get('APP_LICENSE_INFO_REGDATE'))->isoFormat('LL') : '' }}</em></p>
				<p>Next Due: <em>@if(Setting::get('APP_LICENSE_INFO_NEXTDUE')){{ Setting::get('APP_LICENSE_INFO_NEXTDUE') != '0000-00-00' ? \Carbon::parse(Setting::get('APP_LICENSE_INFO_NEXTDUE'))->isoFormat('LL') : 'Never' }}@endif</em></p>
				<p>Billing Cycle: <em>{{ Setting::get('APP_LICENSE_INFO_CYCLE') }}</em></p>
			</div>
		</div>

	</div>

</div>
@stop