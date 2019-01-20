@extends('emails.layouts.main')
@section('subject', trans('email.auth.forgotpassword.title'))
@section('content') 

{{ trans('email.auth.forgotpassword.desc') }}<br><br>

{{ trans('email.auth.forgotpassword.url') }}: <a href="{{ $link }}">{{ $link }}</a><br>
<small>{{ $link }}</small><br><br>


{{ trans('email.auth.forgotpassword.questions') }}<br>

@stop