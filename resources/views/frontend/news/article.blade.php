@extends('layouts.main')
@section('title') Article @stop

@section('content')

<div class="container">

  <div class="row">

    <div class="col s12">

      <h1 class="post-title">{{ $title }}</h1>
      <span class="post-date">{{ date(User::getUserDateFormat(), strtotime($published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($published_at)) }} by <a href="{{ URL::route('user-profile', User::getUsernameByID($author_id)) }}">{{ User::getFullnameByID($author_id) }}</a></span>

      {{ $content }}
    </div>

  </div>

</div>

@endsection
