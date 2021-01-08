@extends('emails.layouts.main')
@section('subject', $subject)
@section('content') 

<p>{{ __('email.hello', ['firstname' => $firstname]) }}</p>
{!! $content !!}

@stop