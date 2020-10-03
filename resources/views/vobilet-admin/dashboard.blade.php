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

	@if(!Setting::get('APP_SCHEDULE_LAST_RUN') || Carbon::parse(Setting::get('APP_SCHEDULE_LAST_RUN'))->diffInMinutes(Carbon::now()) > 5)
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-danger">
				<strong class="text-uppercase"><i class="far fa-frown mr-2" aria-hidden="true"></i> Schedule is not running!</strong>
				<hr class="message-inner-separator">
				<p>It was last ran at <strong>{{ Setting::get('APP_SCHEDULE_LAST_RUN') ?? 'N/A' }}</strong>. If this is not running a lot of automated tasks will not do their work.</p>
			</div>
		</div>
	@endif

	@if(!env('STRIPE_API_KEY'))
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-danger">
				<strong class="text-uppercase"><i class="far fa-frown mr-2" aria-hidden="true"></i> Missing critical environment value</strong>
				<hr class="message-inner-separator">
				<p>The Stripe API key has not been set in the environment file. You will not be able to accept payments!</p>
			</div>
		</div>
	@endif

	@if(!env('MAIL_DRIVER') || !env('MAIL_HOST') || !env('MAIL_PORT') || !env('MAIL_USERNAME') || !env('MAIL_PASSWORD') || !env('MAIL_ENCRYPTION') || !env('MAIL_FROM_NAME') || !env('MAIL_FROM_ADDRESS'))
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-danger">
				<strong class="text-uppercase"><i class="far fa-frown mr-2" aria-hidden="true"></i> Missing critical environment value</strong>
				<hr class="message-inner-separator">
				<p>One or more mail keys in the environment file. Users will not be able get emails from this application!</p>
			</div>
		</div>
	@endif

	
	@if(!env('TWILIO_SID') || !env('TWILIO_TOKEN') || !env('TWILIO_FROM'))
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-warning">
				<strong class="text-uppercase"><i class="fa fa-exclamation mr-2" aria-hidden="true"></i> Missing environment value</strong>
				<hr class="message-inner-separator">
				<p>You are missing one or more Twilio keys in the environment file. Users will not be able to verify their phone numbers!</p>
			</div>
		</div>
	@endif

	@if(!env('AUTHY_SECRET'))
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-warning">
				<strong class="text-uppercase"><i class="fa fa-exclamation mr-2" aria-hidden="true"></i> Missing environment value</strong>
				<hr class="message-inner-separator">
				<p>You are missing the Authy keys in the environment file. Users will not be able to setup two factor authentication!</p>
			</div>
		</div>
	@endif

	@if(env('APP_ENV') != 'production')
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-info">
				<strong class="text-uppercase"><i class="fa fa-exclamation mr-2" aria-hidden="true"></i> Environemnt Information</strong>
				<hr class="message-inner-separator">
				<p>You have set '{{ env('APP_ENV') }}' as the environment in the environment file. Make sure this is correct.</p>
			</div>
		</div>
	@endif

	@if(!env('SENTRY_LARAVEL_DSN'))
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-warning">
				<strong class="text-uppercase"><i class="fa fa-exclamation mr-2" aria-hidden="true"></i> Missing environment value</strong>
				<hr class="message-inner-separator">
				<p>There is no value for Sentry in the environment file. If this is not set, the developers will not get application error alerts.</p>
			</div>
		</div>
	@endif

	@if(!\LANMS\Info::getContent('address_city') || !\LANMS\Info::getContent('address_country') || !\LANMS\Info::getContent('address_county') || !\LANMS\Info::getContent('address_postal_code') || !\LANMS\Info::getContent('address_street'))
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="alert alert-danger">
				<strong class="text-uppercase"><i class="far fa-frown mr-2" aria-hidden="true"></i> Missing critical info value</strong>
				<hr class="message-inner-separator">
				<p>One or more address fields in Info is missing. You need this to be able to send invoices! <a href="{{ route('admin-info') }}" class="alert-link">Click here to fix it!</a></p>
			</div>
		</div>
	@endif

</div>

<div class="row">

	<div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
		<div class="card no-scroll p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-blue mr-3">
					<i class="fa fa-users"></i>
				</span>
				<div>
					<h4 class="m-0"><a href="{{ route('admin-users') }}"><strong>{{ User::whereNotNull('last_activity')->orWhere('isAnonymized', '0')->orWhereNotNull('deleted_at')->count() }}</strong> <small>Users</small></a></h4>
					<small class="text-muted">{{ User::onlyTrashed()->count() }} deleted</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
		<div class="card no-scroll p-3">
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

	<div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
		<div class="card no-scroll p-3">
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

	<div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
		<div class="card no-scroll p-3">
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

	<div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
		<div class="card no-scroll p-3">
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

	<div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
		<div class="card no-scroll p-3">
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
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
			<div class="card no-scroll">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="text-muted">Active users</div>
							<div class="h3 m-0"><b>{{ User::whereNotNull('last_activity')->orWhere('isAnonymized', '0')->orWhereNotNull('deleted_at')->count() ?? 1 }} <small>/{{ User::withTrashed()->count() }}</small></b></div>
						</div>
						<div class="col-auto align-self-center">
							<div class="chart-circle chart-circle-xs" data-value="{{ sprintf("%.2f", User::whereNotNull('last_activity')->orWhere('isAnonymized', '1')->orWhereNotNull('deleted_at')->count() / User::withTrashed()->count()) }}" data-thickness="6" data-color="#0061da"><canvas width="40" height="40"></canvas></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	@if(Checkin::thisYear()->count() > 0)
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
			<div class="card no-scroll">
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

	@if(SeatReservation::thisYear()->onlyReserved()->count() > 0)
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
			<div class="card no-scroll">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="text-muted">Paid Reservations</div>
							<div class="h3 m-0"><b>{{ SeatReservation::thisYear()->onlyReserved()->isPaid()->count() }} <small>/{{ SeatReservation::thisYear()->onlyReserved()->count() }}</small></b></div>
						</div>
						<div class="col-auto align-self-center ">
							<div class="chart-circle chart-circle-xs" data-value="{{ sprintf("%.2f", SeatReservation::thisYear()->onlyReserved()->isPaid()->count() / SeatReservation::thisYear()->onlyReserved()->count()) }}" data-thickness="6" data-color="#17a2b8"><canvas width="40" height="40"></canvas></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	@if(SeatReservation::thisYear()->onlyTempReserved()->count() > 0)
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
			<div class="card no-scroll">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="text-muted">Temporary Reserved Reservations</div>
							<div class="h3 m-0"><b>{{ SeatReservation::thisYear()->onlyTempReserved()->count() }} <small>/{{ SeatReservation::thisYear()->count() }}</small></b></div>
						</div>
						<div class="col-auto align-self-center ">
							<div class="chart-circle chart-circle-xs" data-value="{{ sprintf("%.2f", SeatReservation::thisYear()->onlyTempReserved()->count() / SeatReservation::thisYear()->count()) }}" data-thickness="6" data-color="#17a2b8"><canvas width="40" height="40"></canvas></div>
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