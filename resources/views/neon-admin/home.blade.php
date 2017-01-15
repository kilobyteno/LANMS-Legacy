@extends('layouts.main')
@section('title', 'Admin Dashboard')
   
@section('content')
<div class="row">
	<div class="col-md-12">
		<h1 class="margin-bottom">Admin Dashboard</small></h1>
		<ol class="breadcrumb 2" >
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li class="active"><strong>Admin Dashboard</strong></li>
		</ol>
					
		<br />

		<div class="row">
			<div class="col-sm-3">
				<a class="tile-stats tile-aqua">
					<div class="icon"><i class="fa fa-users"></i></div>
					<div class="num" data-start="0" data-end="{{User::all()->count()}}" data-duration="1500" data-delay="0">{{User::all()->count()}}</div>
					<h3>Registered users</h3>
					<p>so far on our website.</p>
				</a>
			</div>
			<div class="col-sm-3">
				<a class="tile-stats tile-cyan" href="{{route('admin-seating')}}">
					<div class="icon"><i class="fa fa-street-view"></i></div>
					<div class="num" data-start="0" data-end="{{SeatReservation::thisYear()->count()}}" data-duration="1500" data-delay="0">{{SeatReservation::thisYear()->count()}}</div>
					<h3>Seat reservations</h3>
					<p>so far this year.</p>
				</a>
			</div>
			<div class="col-sm-3">
				<a class="tile-stats tile-gray" href="{{route('admin-news')}}">
					<div class="icon"><i class="fa fa-newspaper-o"></i></div>
					<div class="num" data-start="0" data-end="{{News::isPublished()->count()}}" data-duration="1500" data-delay="0">{{News::isPublished()->count()}}</div>
					<h3>News articles</h3>
					<p>published.</p>
				</a>
			</div>
			<div class="col-sm-3">
				<a class="tile-stats tile-primary" href="{{route('admin-pages')}}">
					<div class="icon"><i class="fa fa-file-text"></i></div>
					<div class="num" data-start="0" data-end="{{Page::all()->count()}}" data-duration="1500" data-delay="0">{{Page::all()->count()}}</div>
					<h3>Pages</h3>
					<p>created and shown on the website.</p>
				</a>
			</div>
		</div>
	</div>
</div>
@stop