@extends('emails.layouts.main')
@section('subject', trans('email.seat.removedsoon.title'))
@section('content') 

{{ trans('email.seat.removedsoon.desc', ['seatname' => $seatname]) }}<br>

@stop