@extends('layouts.main')
@section('title', $username . ' - Profile')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Profile</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item active" aria-current="page">Profile</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-profile " style="background: url({{ $profilecover or '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<img class="card-profile-img" src="{{ $profilepicture or '/images/profilepicture/0.png' }}">
					<h3 class="mb-3 text-white">{{ $firstname }}@if($showname) {{ $lastname }}@endif</h3>
					@if(Sentinel::findById($id)->inRole('admin') || Sentinel::findById($id)->inRole('superadmin') || Sentinel::findById($id)->inRole('moderator'))
						<p class="mb-4 text-white">Staff</p>
					@else
						<p class="mb-4 text-white">Member</p>
					@endif
					@if(\Sentinel::getUser()->id == $id)
						<a href="{{ route('user-profile-edit', $username) }}" class="btn btn-light btn-sm"><i class="fa fa-pencil-alt"></i> Edit Profile</a>
					@endif
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Attendence</h3>
				</div>
				@if(Sentinel::findById($id)->ownReservationsThisYear->count()>0 || Sentinel::findById($id)->ownReservationsLastYear->count()>0)
					<div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
							<tbody>
								@if(Sentinel::findById($id)->ownReservationsThisYear->count()>0)
									@foreach(Sentinel::findById($id)->ownReservationsThisYearDecending as $reservation)
										<tr>
											<td class="no-border">Reserved a seat for {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</td>
											<td class="no-border text-right"><span class="tag tag-rounded">{{ date('M Y', strtotime($reservation->created_at)) }}</span></td>
										</tr>
									@endforeach
								@endif
								@if(Sentinel::findById($id)->ownReservationsLastYear->count()>0)
									@foreach(Sentinel::findById($id)->ownReservationsLastYearDecending as $reservation)
										<tr>
											<td class="no-border">Reserved a seat for {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</td>
											<td class="no-border text-right"><span class="tag tag-rounded">{{ date('M Y', strtotime($reservation->created_at)) }}</span></td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				@else
					<div class="card-body"><p class="text-muted"><em>No attendance yet.</em></p></div>
				@endif
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-body">
					<div id="profile-log-switch">
						<div class="fade show active">
							<div class="table-responsive border">
								<table class="table row table-borderless w-100 m-0">
									<tbody class="col-lg-6 p-0">
										<tr>
											<td><strong>Username:</strong> {{ $username }}</td>
										</tr>
										<tr>
											<td><strong>Joined:</strong> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $created_at }}">{{ \Carbon::parse($created_at)->diffForHumans() }}</span></td>
										</tr>
										@if($location)
											<tr>
												<td><strong>Location:</strong> {{ $location }}</td>
											</tr>
										@endif
										@if($gender)
											<tr>
												<td><strong>Gender:</strong> <i class="fa fa-{{ User::getGenderIcon($gender) }}"></i> {{ $gender }}</td>
											</tr>
										@endif
									</tbody>
									<tbody class="col-lg-6 p-0">
										@if($showemail)
											<tr>
												<td><strong>Email:</strong> {{ $email }}</td>
											</tr>
										@endif
										@if($showonline)
											<tr>
												<td><strong>Last seen:</strong> {{ \Carbon::parse($last_login)->diffForHumans() }}</td>
											</tr>
										@endif
										@if($occupation)
											<tr>
												<td><strong>Email :</strong> {{ $occupation }}</td>
											</tr>
										@endif
										@if($birthdate)
											<tr>
												<td><strong>Age:</strong> {{ date_diff(date_create($birthdate), date_create('today'))->y }} years old</td>
											</tr>
										@endif
									</tbody>
								</table>
							</div>
							@if($about)
								<div class="row mt-5">
									<div class="col-md-12">
										<div class="media-heading">
											<h5><strong>About</strong></h5>
										</div>
										<p>{{ $about }}</p>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop