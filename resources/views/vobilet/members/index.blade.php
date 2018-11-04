@extends('layouts.main')
@section('title', 'Members')
@section('content')

<div class="container">
	<div class="page-header">
		<h1 class="page-title">Users</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item active" aria-current="page">Members</li>
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
					<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
				</div>
			</form>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Newest Members</h3>
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
					<h3 class="card-title">Last Online Members</h3>
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
								<th>Username</th>
								<th>Name</th>
								<th class="d-none d-sm-table-cell">Joined</th>
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
			<p class="text-muted">{{ $members->count() }} total members</p>
			{!! $members->render() !!}
		</div>
	</div>
</div>
@stop