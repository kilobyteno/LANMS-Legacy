@extends('layouts.main')
@section('title', trans('pages.members.search.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h1 class="page-title">{{ trans('pages.members.search.title') }}: <em>{{ $query }}</em></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
			<li class="breadcrumb-item">{{ trans('header.members') }}</li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('pages.members.search.title') }}</li>
		</ol>
	</div>
	<div class="row row-cards">
		<div class="col-lg-4">
			<form class="card" method="post" action="{{ route('members-search') }}">
				<div class="card-body">
					<div class="form-group">
						<div class="form-label">Search Members</div>
						<input type="text" class="form-control" name="search" placeholder="Username or Name">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> {{ trans('pages.members.search.button') }}</button>
				</div>
			</form>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('pages.members.newest.title') }}</h3>
				</div>
				<div class="card-body o-auto" style="height: 15rem">
					<ul class="list-unstyled list-separated">
						@foreach($newestmembers as $member)
							<li class="list-separated-item">
								<div class="row align-items-center">
									<div class="col-auto">
										<span class="avatar brround avatar-md d-block" style="background-image: url({{ $member->profilepicture ?? '/images/profilepicture/0.png' }})"></span>
									</div>
									<div class="col">
										<div>
											<a href="{{ route('user-profile', $member->username) }}" class="text-inherit">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
										</div>
										<small class="d-block item-except text-sm text-muted h-1x">{{ $member->username }}</small>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('pages.members.lastonline.title') }}</h3>
				</div>
				<div class="card-body o-auto" style="height: 15rem">
					<ul class="list-unstyled list-separated">
						@foreach($onlinemembers as $member)
							<li class="list-separated-item">
								<div class="row align-items-center">
									<div class="col-auto">
										<span class="avatar brround avatar-md d-block" style="background-image: url({{ $member->profilepicture ?? '/images/profilepicture/0.png' }})"></span>
									</div>
									<div class="col">
										<div>
											<a href="{{ route('user-profile', $member->username) }}" class="text-inherit">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
										</div>
										<small class="d-block item-except text-sm text-muted h-1x">{{ $member->username }}</small>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="table-responsive">
					<table class="table card-table table-vcenter">
						<tbody>
							<tr>
								<th class="w-1"></th>
								<th>{{ trans('pages.members.table.username') }}</th>
								<th>{{ trans('pages.members.table.name') }}</th>
								<th class="d-none d-sm-table-cell">{{ trans('pages.members.table.joined') }}</th>
							</tr>
						@foreach($members as $member)
							<tr>
								<td><a href="{{ route('user-profile', $member->username) }}"><span class="avatar d-block rounded" style="background-image: url({{ $member->profilepicture ?? '/images/profilepicture/0.png' }})"></span></a></td>
								<td><a href="{{ route('user-profile', $member->username) }}" class="text-inherit">{{ $member->username }}</a></td>
								<td><a href="{{ route('user-profile', $member->username) }}" class="text-inherit">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a></td>
								<td class="d-none d-sm-table-cell"><span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $member->created_at }}">{{ \Carbon::parse($member->created_at)->diffForHumans() }}</span></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<p class="text-muted">{{ $members->count() }} {{ trans('pages.members.search.results') }}</p>
		</div>
	</div>
</div>
@stop