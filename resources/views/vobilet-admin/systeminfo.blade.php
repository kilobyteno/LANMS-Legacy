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
	<div class="card text-white @if(!Setting::get('APP_SCHEDULE_LAST_RUN') || Carbon::parse(Setting::get('APP_SCHEDULE_LAST_RUN'))->diffInMinutes(Carbon::now()) > 5) bg-danger @elseif(Carbon::parse(Setting::get('APP_SCHEDULE_LAST_RUN'))->diffInMinutes(Carbon::now()) < 5) bg-success @endif">
		<div class="card-header">
			<div class="card-title">Schedule</div>
		</div>
		<div class="card-body">
			<p><strong class="text-uppercase">Last run:</strong> <span data-toggle="tooltip" data-placement="right" title="{{ Setting::get('APP_SCHEDULE_LAST_RUN') ?? ':(' }}">@if(Setting::get('APP_SCHEDULE_LAST_RUN')){{ Carbon::parse(Setting::get('APP_SCHEDULE_LAST_RUN'))->diffForHumans() }}@else Never. @endif</span></p>
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
			<div class="card-title">Carbon</div>
		</div>
		<div class="card-body">
			<p><strong class="text-uppercase">Now:</strong> {{ Carbon::now() }}</p>
			<p><strong class="text-uppercase">toDateString:</strong> {{ Carbon::now()->toDateString() }}</p>
			<p><strong class="text-uppercase">toFormattedDateString:</strong> {{ Carbon::now()->toFormattedDateString() }}</p>
			<p><strong class="text-uppercase">toTimeString:</strong> {{ Carbon::now()->toTimeString() }}</p>
			<p><strong class="text-uppercase">toDateTimeString:</strong> {{ Carbon::now()->toDateTimeString() }}</p>
			<p><strong class="text-uppercase">toDayDateTimeString:</strong> {{ Carbon::now()->toDayDateTimeString() }}</p>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">Host</div>
		</div>
		<div class="card-body">
			@foreach(Larinfo::getHostIpinfo() as $key => $value)
				<p><strong class="text-uppercase">{{ $key }}:</strong> {{ $value }}</p>
			@endforeach
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">Client</div>
		</div>
		<div class="card-body">
			@foreach(Larinfo::getClientIpinfo() as $key => $value)
				<p><strong class="text-uppercase">{{ $key }}:</strong> {{ $value }}</p>
			@endforeach
		</div>
	</div>
</div>
@stop