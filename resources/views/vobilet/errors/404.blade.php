@extends('layouts.main')
@section('title', 'Page not found')
@section('content')

<div class="container text-center">
	<div class="page-header">
		<h4 class="page-title">Page not found</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Page not found</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="display-1 text-dark mb-5">404</div>
			<h1>Seems like this page does not exist.</h1>
			<p><a class="btn btn-primary mt-10" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Home</a></p>
		</div>		
	</div>
</div>
@stop