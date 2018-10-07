@extends('layouts.main')
@section('title', 'User')
@section('content')

<div class="page-header">
	<h4 class="page-title">User</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Home</li>
		<li class="breadcrumb-item active" aria-current="page">User</li>
	</ol>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(Sentinel::getUser()->ownReservationsLastYear->count() > 0 && !Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> We can see that you attended last year. Want to join us for this year too? <a href="{{route('seating')}}">Check out the seating now</a>.
				</div>
			@endif
			@if(Sentinel::getUser()->age() < 16 && Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Vi kan se at du er under 16 år og på arrangementet må ha med samtykkeskjema ferdig utfyllt ved innskjekking. Ferdig generert skjema finner du her: <a href="{{ route('seating-consentform') }}"><i class="fa fa-user-circle-o"></i> Samtykkeskjema</a>
				</div>
			@endif
			@if(!Sentinel::getUser()->birthdate)
				<div class="alert alert-warning" role="alert">
					<i class="fa fa-exclamation-triangle"></i> There is no birthdate assigned to your account, this is required from now on. Edit it here: <a href="{{ route('account-change-details') }}"> Change Account Details</a>
				</div>
			@endif
			<div class="row">
				<div class="col-lg-8 col-lg-8 col-sm-8">
					@foreach($news as $article)
						<div class="card">
							<div class="card-body d-flex flex-column">
								<h4><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h4>
								<div class="text-muted">{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif</div>
								<div class="d-flex align-items-center pt-5 mt-auto">
									<div class="avatar brround avatar-md mr-3" style="background-image: url(@if($article->author->profilepicturesmall){{ $article->author->profilepicturesmall }} @else {{ '/images/profilepicture/0_small.png' }}@endif)"></div>
									<div> <a href="{{ URL::route('user-profile', $article->author->username) }}" class="text-default">{{ User::getFullnameByID($article->author->id) }}</a> <small class="d-block text-muted">{{ $article->published_at->diffForHumans() }}</small> </div>
									<div class="ml-auto text-muted"> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-thumbs-o-up"></i></a> </div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Quick Links</h2>
						</div>
						<div class="">
							<table class="table card-table">
								<tbody>
									<tr class="border-bottom">
										<td><a href="{{ route('account') }}"><i class="fa fa-user"></i> Your Account</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('user-profile', \Sentinel::getUser()->username) }}"><i class="fa fa-user-circle"></i> Your Profile</a></td>
									</tr>
									<tr class="border-bottom">
										<td><a href="{{ route('account-change-password') }}"><i class="fa fa-asterisk"></i> Change password</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					@if(Sentinel::getUser()->reservationsThisYear()->count()>0)
						<h5>Your reservations:</h5>
						@foreach(Sentinel::getUser()->reservationsThisYear()->get() as $reservation)
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><a href="{{ route('seating-show', $reservation->seat->slug) }}">{{ $reservation->seat->name }} &middot; {{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a></h3>
									<div class="card-options">
										@if($reservation->payment)
											<span class="badge badge-success">Paid</span>
										@else
											<span class="badge badge-danger">Unpaid</span>
										@endif
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop