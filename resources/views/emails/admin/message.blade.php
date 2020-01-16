@extends('emails.layouts.main')
@section('subject', $subject)
@section('content') 

<p>{{ trans('email.hello', ['firstname' => $firstname]) }}</p>
{!! $content !!}

@stop