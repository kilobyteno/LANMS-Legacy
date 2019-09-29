@extends('layouts.main')
@section('title', 'System Info - Admin')
   
@section('content')

<div class="page-header">
	<h4 class="page-title">System Info</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">System Info</li>
	</ol>
</div>

<div class="card-columns">
	<div class="card">
		<div class="card-header">
			<div class="card-title">Client</div>
		</div>
		<div class="card-body">
			@foreach(Larinfo::getHostIpinfo() as $key => $value)
				<p><strong class="text-uppercase">{{ $key }}:</strong> {{ $value }}</p>
			@endforeach
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">Uptime</div>
		</div>
		<div class="card-body">
			@foreach(Larinfo::getUptime() as $key => $value)
				<p><strong class="text-uppercase">{{ $key }}:</strong> {{ $value }}</p>
			@endforeach
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">MySQL</div>
		</div>
		<div class="card-body">
			@foreach(Larinfo::getDatabaseInfo() as $key => $value)
				<p><strong class="text-uppercase">{{ $key }}:</strong> {{ $value }}</p>
			@endforeach
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">Server Software</div>
		</div>
		<div class="card-body">
			@foreach(Larinfo::getServerInfoSoftware() as $key => $value)
				<p><strong class="text-uppercase">{{ $key }}:</strong> {{ $value }}</p>
			@endforeach
		</div>
	</div>
</div>
@stop