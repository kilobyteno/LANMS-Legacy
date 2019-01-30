@extends('layouts.main')
@section('title', 'Show Broken Band - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Show Broken Band</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item"><a href="{{ route('admin-seating-brokenband') }}">Broken Bands</a></li>
		<li class="breadcrumb-item active" aria-current="page">Show Broken Band</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="row">
		
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('admin-seating-brokenband-store', $checkin->id) }}" method="post">
							<div class="row">
								<div class="col-sm-4 @if($errors->has('new_band_number')) has-error @endif">
									<input type="text" class="form-control input-lg" name="new_band_number" placeholder="New Band Number" value="{{ (old('new_band_number')) ? old('new_band_number') : '' }}" autocomplete="off" />
									@if($errors->has('new_band_number'))
										<p class="text-danger">{{ $errors->first('new_band_number') }}</p>
									@endif
								</div>
								<div class="col-sm-4 input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">Old Band Number:</div>
									</div>
									<input type="text" class="form-control disabled" value="{{ $checkin->bandnumber }}" disabled="" />
									<input type="hidden" class="hidden" name="band_number" value="{{ $checkin->bandnumber }}" />
								</div>
								<div class="col-sm-2 input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">Checkin ID:</div>
									</div>
									<input type="text" class="form-control disabled" value="{{ $checkin->id }}" disabled="" />
								</div>
								<div class="col-sm-2">
									<button type="submit" class="btn btn-warning btn-block" id="change"><i class="fas fa-exchange-alt mr-2"></i>Change Broken Band</button>
								</div>
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
			</div>

		</div>
		<br />

	</div>
</div>

@stop