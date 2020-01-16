@extends('layouts.main')
@section('title', 'Atendee Check-in - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Show Atendee Check-in</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-checkin') }}">Atendee Check-in</a></li>
		<li class="breadcrumb-item active" aria-current="page">Show</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('admin-seating-checkin-store', $ticket->id) }}" method="post">
							<div class="row">
								<div class="col-sm-3">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="idcheck">
										<span class="custom-control-label">I have checked the ID of the atendee</span>
									</label>
								</div>
								<div class="col-sm-3">
									@if($ticket->user->age() < 15)
										<div class="form-label text-danger">Antendee needs to have a consent form in paper form:</div>
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="consentform">
											<span class="custom-control-label">Atendee has shown consent form and we have signed it</span>
										</label>
										<p>If needed; check the permission from the parents by calling.</p>
									@else
										<div class="form-label text-success">Antendee does not need a consent form</div>
										<input type="checkbox" style="display: none;" id="consentform" checked>
									@endif
								</div>
								<div class="col-sm-3">
									@if(is_null($ticket->reservation->payment))
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="paid">
											<span class="custom-control-label">Atendee has paid the total amount</span>
										</label>
									@else
										<div class="form-label text-success">Antendee has nothing to pay</div>
										<input type="checkbox" style="display: none;" id="paid" checked>
									@endif
								</div>
								<div class="col-sm-3 input-group">
									<input type="text" class="form-control input-lg" name="band_number" placeholder="Band Number" value="{{ (old('band_number')) ? old('band_number') : '' }}" autocomplete="off" />
									@if($errors->has('band_number'))
										<p class="text-danger">{{ $errors->first('band_number') }}</p>
									@endif
									<span class="input-group-append">
										<button type="submit" class="btn btn-success btn-block btn-icon" id="checkin" disabled=""><i class="fas fa-check mr-2"></i>Check-in</button>
									</span>
								</div>
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
			</div>
		</div>

		<br /><hr><br />

		<div class="row">

			<div class="col-md-6 text-center">
				<div class="row">
					<div class="col-md-6">
						@if(is_null($ticket->reservation->payment))
							<h2><strong><small>Paid:</small><br><span class="text-danger">No</span></strong></h2>
							<h3><small>To pay:</small><br>{{ Setting::get('SEATING_SEAT_PRICE_ALT') }} {{ Setting::get('MAIN_CURRENCY') }}</h3>
						@else
							<h2><strong><small>Paid:</small><br><span class="text-success">Yes</span></strong></h2>
						@endif
					</div>
					<div class="col-md-6">
						<h2><strong><small>Seat:</small><br>{{ $ticket->reservation->seat->name }}</strong></h2>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card card-profile " style="background: url({{ $ticket->user->profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
					<div class="card-body text-center">
						<img class="card-profile-img" src="{{ $ticket->user->profilepicture ?? '/images/profilepicture/0.png' }}">
						<h3 class="mb-3 text-white">{{ $ticket->user->firstname . ' "' . $ticket->user->username . '" ' . $ticket->user->lastname }}</h3>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div id="profile-log-switch">
							<div class="fade show active">
								<div class="table-responsive border">
									<table class="table row table-borderless w-100 m-0">
										<tbody class="col-lg-6 p-0">
											<tr>
												<td><strong>{{ trans('global.phone') }}:</strong> {!! $ticket->user->phone ?? '<strong class="text-danger">NO PHONE!</strong>' !!}</td>
											</tr>
											@if($ticket->user->birthdate)
												<tr>
													<td><strong>{{ trans('global.age') }}:</strong> {{ \Carbon::parse($ticket->user->birthdate)->age }} {{ trans('global.yearsold') }} ({{ $ticket->user->birthdate }})</td>
												</tr>
											@endif
										</tbody>
										<tbody class="col-lg-6 p-0">
											@if($ticket->user->showonline && $ticket->user->last_activity && $ticket->user->last_activity != '0000-00-00 00:00:00')
												<tr>
													<td><strong>{{ trans('global.lastseen') }}:</strong> {{ \Carbon::parse($ticket->user->last_activity)->diffForHumans() }}</td>
												</tr>
											@endif
											<tr>
												<td><strong>{{ trans('global.joined') }}:</strong> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $ticket->user->created_at }}">{{ \Carbon::parse($ticket->user->created_at)->diffForHumans() }}</span></td>
											</tr>
											@if($ticket->user->gender)
												<tr>
													<td><strong>{{ trans('global.gender.title') }}:</strong> <i class="fa fa-{{ User::getGenderIcon($ticket->user->gender) }}"></i> {{ trans('global.gender.'.strtolower($ticket->user->gender)) }}</td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
								@if($ticket->user->about)
									<div class="row mt-5">
										<div class="col-md-12">
											<div class="media-heading">
												<h5><strong>{{ trans('global.about') }}</strong></h5>
											</div>
											<p>{{ $ticket->user->about }}</p>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 text-center">
				
			</div>

		</div>

	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		var idcheck = document.getElementById('idcheck');
		var paid = document.getElementById('paid');
		var consentform = document.getElementById('consentform');
		var btn = document.getElementById('checkin');
		function validate() {
			if(idcheck.checked && paid.checked && consentform.checked) {
				console.log("checked");
				btn.disabled = false;
			} else {
				btn.disabled = true;
				console.log("not checked");
			}
		}
		idcheck.onchange = function() {
			validate();
		}
		paid.onchange = function() {
			validate();
		}
		consentform.onchange = function() {
			validate();
		}
	</script>
@stop