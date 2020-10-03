@extends('emails.layouts.main')
@section('subject', __('email.auth.activate.title'))
@section('content') 

<p>{{ __('email.auth.activate.hello', ['firstname' => $firstname]) }}</p>
<p><a href="{{ $link }}">{{ $link }}</a></p>

@stop