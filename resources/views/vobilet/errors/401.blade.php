@extends('layouts.main')
@section('title', 'Unauthorized')
@section('content')

<div class="container text-center">
	<div class="page-header">
		<h4 class="page-title">Unauthorized</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Unauthorized</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="display-1 text-dark mb-5">401</div>
			<h1>Authentication is required and has failed or has not yet been provided.</h1>
			<p><a class="btn btn-primary mt-10" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Home</a></p>
		</div>		
	</div>
</div>
@stop