@extends('layouts.main')
@section('title', 'License Status - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">License Status</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>License Status</strong></li>
		</ol>
		
		<p>Status: {{ Setting::get('APP_LICENSE_STATUS') }}</p>

		<p>Description: {{ Setting::get('APP_LICENSE_STATUS_DESC') }}</p>

		<a href="{{ route('admin-license-check') }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-refresh"></i> Check License Status</a>

	</div>
</div>
@stop