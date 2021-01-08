@extends('layouts.main')
@section('title', __('pages.errors.500.title'))
@section('content')

<div class="container text-center">
    <div class="page-header">
        <h4 class="page-title">{{ __('pages.errors.500.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('pages.errors.500.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="display-1 mb-5">500</div>
            <h1>{{ __('pages.errors.500.desc') }}</h1>
            <p>Error ID: {{ Sentry::getLastEventID() ?? 'N/A' }}</p>
            <p><a class="btn btn-primary mt-10" href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> {{ __('pages.errors.button') }}</a></p>
        </div>      
    </div>
</div>
@if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
    <script src="https://cdn.ravenjs.com/3.26.4/raven.min.js"></script>
    <script>
        Raven.showReportDialog({
            eventId: '{{ Sentry::getLastEventID() }}',
            dsn: 'https://e9ebbd88548a441288393c457ec90441@sentry.io/3235',
            user.email: '{{ \Sentinel::getUser()->email ?? "Unknown" }}',
            user.name: '{{ \Sentinel::getUser()->username ?? "Unknown" }}'
        });
    </script>
@endif
@stop