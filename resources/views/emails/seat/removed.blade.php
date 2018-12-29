@extends('emails.layouts.main')
@section('subject', trans('email.seat.removed.title'))
@section('content') 

{{ trans('email.seat.removed.desc', ['seatname' => $seatname]) }}<br>

@stop