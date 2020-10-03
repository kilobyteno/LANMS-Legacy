@extends('layouts.main')
@section('title', __('pages.errors.404.title'))
@section('content')

<div class="container text-center">
	<div class="page-header">
		<h4 class="page-title">{{ __('pages.errors.404.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('pages.errors.404.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="display-1 mb-5">404</div>
			<h1>{{ __('pages.errors.404.desc') }}</h1>
			<p><a class="btn btn-primary mt-10" href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> {{ __('pages.errors.button') }}</a></p>
		</div>		
	</div>
</div>
@stop