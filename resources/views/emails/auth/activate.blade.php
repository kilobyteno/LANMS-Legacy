@extends('emails.layouts.main')
@section('subject', trans('email.auth.activate.title'))
@section('content') 

<p>{{ trans('email.auth.activate.hello', ['firstname' => $firstname]) }}</p>
<p><a href="{{ $link }}">{{ $link }}</a></p>

@stop