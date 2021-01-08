@extends('emails.layouts.main')
@section('subject', __('email.auth.forgotpassword.title'))
@section('content') 

{{ __('email.auth.forgotpassword.desc') }}<br><br>

{{ __('email.auth.forgotpassword.url') }}: <a href="{{ $link }}">{{ $link }}</a><br>
<small>{{ $link }}</small><br><br>


{{ __('email.auth.forgotpassword.questions') }}<br>

@stop