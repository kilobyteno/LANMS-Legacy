@extends('layouts.main')
@section('title', 'Dashboard - Admin')
   
@section('content')
<div class="page-header">
	<h4 class="page-title">Dashboard</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
	</ol>
</div>

<div class="row">
	<div class="col-sm-6 col-lg-2">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-blue mr-3">
					<i class="fa fa-users"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-users') }}"><strong>{{ User::where('last_activity', '<>', '')->orWhere('isAnonymized', '0')->orWhere('deleted_at', '<>', '')->count() }}</strong> <small>Users</small></a></h4>
					<small class="text-muted">{{ User::onlyTrashed()->count() }} deleted</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-2">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-indigo mr-3">
					<i class="fa fa-newspaper"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-news') }}"><strong>{{ News::isPublished()->count() }}</strong> <small>Articles</small></a></h4>
					<small class="text-muted">{{ News::onlyTrashed()->count() }} trashed</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-2">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-purple mr-3">
					<i class="fa fa-file-alt"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-pages') }}"><strong>{{ Page::all()->count() }}</strong> <small>Pages</small></a></h4>
					<small class="text-muted">{{ Page::onlyTrashed()->count() }} trashed</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-2">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-teal mr-3">
					<i class="fa fa-street-view"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-seating-reservations') }}"><strong>{{ SeatReservation::thisYear()->count() }}</strong> <small>Reservations</small></a></h4>
					<small class="text-muted">{{ SeatReservation::thisYear()->onlyTrashed()->count() }} deleted reservations</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-2">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-cyan mr-3">
					<i class="fas fa-user-astronaut"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-seating-checkin-visitor') }}"><strong>{{ Visitor::thisYear()->count() }}</strong> <small>Visitors</small></a></h4>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-2">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-indigo mr-3">
					<i class="fa fa-street-view"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-crew') }}"><strong>{{ Crew::thisYear()->count() }}</strong> <small>Crew</small></a></h4>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row row-cards">
	
	@if(User::withTrashed()->count() > 0)
		<div class="col-sm-12 col-md-6 col-lg-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="text-muted">Active users</div>
							<div class="h3 m-0"><b>{{ User::where('last_activity', '<>', '')->orWhere('isAnonymized', '0')->orWhere('deleted_at', '<>', '')->count() ?? 1 }} <small>/{{ User::withTrashed()->count() }}</small></b></div>
						</div>
						<div class="col-auto align-self-center">
							<div class="chart-circle chart-circle-xs" data-value="{{ sprintf("%.2f", User::where('last_activity', '<>', '')->orWhere('isAnonymized', '1')->orWhere('deleted_at', '<>', '')->count() / User::withTrashed()->count()) }}" data-thickness="6" data-color="#0061da"><canvas width="40" height="40"></canvas></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	@if(Checkin::thisYear()->count() > 0)
		<div class="col-sm-12 col-md-6 col-lg-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="text-muted">Checkins</div>
							<div class="h3 m-0"><b>{{ Checkin::thisYear()->count() }}</b></div>
						</div>
						<div class="col-auto align-self-center ">
							<div class="chart-circle chart-circle-xs" data-value="{{ sprintf("%.2f", Checkin::thisYear()->count() / SeatReservation::thisYear()->count()) }}" data-thickness="6" data-color="#17a2b8"><canvas width="40" height="40"></canvas></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	@if(SeatReservation::thisYear()->count() > 0)
		<div class="col-sm-12 col-md-6 col-lg-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="text-muted">Paid Reservations</div>
							<div class="h3 m-0"><b>{{ SeatReservation::thisYear()->where('payment_id', '<>', '0')->count() }} <small>/{{ SeatReservation::thisYear()->count() }}</small></b></div>
						</div>
						<div class="col-auto align-self-center ">
							<div class="chart-circle chart-circle-xs" data-value="{{ sprintf("%.2f", SeatReservation::thisYear()->where('payment_id', '<>', '0')->count() / SeatReservation::thisYear()->count()) }}" data-thickness="6" data-color="#17a2b8"><canvas width="40" height="40"></canvas></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

</div>
@stop

@section('javascript')
	<script type="text/javascript">
		(function($) {
		    "use strict";

			if ($('.chart-circle').length) {
				$('.chart-circle').each(function() {
					let $this = $(this);

					$this.circleProgress({
					  fill: {
						color: $this.attr('data-color')
					  },
					  size: $this.height(),
					  startAngle: -Math.PI / 4 * 2,
					  lineCap: 'round'
					});
				});
			 }
		})(jQuery);
	</script>
@stop