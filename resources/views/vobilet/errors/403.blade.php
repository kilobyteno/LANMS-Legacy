@extends('layouts.main')
@section('title', 'Forbidden')
@section('content')

<div class="container text-center">
	<div class="page-header">
		<h4 class="page-title">Forbidden</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Forbidden</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="display-1 text-dark mb-5">403</div>
			<h1>Sorry, you are forbidden from accessing this page.</h1>
			<p><a class="btn btn-primary mt-10" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Home</a></p>
		</div>		
	</div>
</div>
@stop