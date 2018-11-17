@extends('layouts.main')
@section('title', 'Server Error')
@section('content')

<div class="container text-center">
    <div class="page-header">
        <h4 class="page-title">Server Error</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Server Error</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="display-1 text-dark mb-5">500</div>
            <h1>Looks like we're having some server issues.</h1>
            <p>Error ID: {{ Sentry::getLastEventID() ?? 'N/A' }}</p>
            <p><a class="btn btn-primary mt-10" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Home</a></p>
        </div>      
    </div>
</div>
@if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
    <script src="https://cdn.ravenjs.com/3.26.4/raven.min.js"></script>
    <script>
        Raven.showReportDialog({
            eventId: '{{ Sentry::getLastEventID() }}',
            dsn: 'https://e9ebbd88548a441288393c457ec90441@sentry.io/3235',
            user.email: '{{ \Sentinel::getUser()->email ?? "" }}',
            user.name: '{{ User::getFullnameByID(\Sentinel::getUser()->id) ?? "" }}'
        });
    </script>
@endif
@stop