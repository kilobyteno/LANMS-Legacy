@extends('layouts.main')
@section('title', 'Email #'.$email->id.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Email #{{ $email->id }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Email #{{ $email->id }}</li>
	</ol>
</div>

<div class="row">
	<div class="col-8">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span class="text-muted">Subject:</span> {{ $email->subject }}</div>
			</div>
			<div class="card-body">
				<div style="border:1px solid #333;">
					{!! $email->content !!}
				</div>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Details</div>
			</div>
			<div class="card-body">
				<p>By: {{ \LANMS\User::getFullnameAndNicknameByID($email->author->id) }}</p>
				<p>Sent: {{ \Carbon\Carbon::parse($email->created_at)->isoFormat('LLL') }}</p>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<div class="card-title">Sent to {{ $email->users->count() }} users</div>
			</div>
			<div class="card-body o-auto" style="min-height: 30em">
				<ul class="list-unstyled list-separated">
					@foreach($email->users as $member)
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
</div>
@stop