@extends('layouts.main')
@section('title', 'Visitor Check-in - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Visitor Check-in</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Visitor Check-in</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">
		
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin-seating-checkin-visitor-store') }}" method="post">
					<div class="row">
						<div class="col-lg-4">
							<input type="text" class="form-control input-lg" name="fullname" placeholder="Full Name" value="{{ (old('fullname')) ? old('fullname') : '' }}" autocomplete="off" />
							@if($errors->has('fullname'))
								<p class="text-danger">{{ $errors->first('fullname') }}</p>
							@endif
						</div>
						<div class="col-lg-4">
							<input type="tel" class="form-control input-lg" name="telephonenumber" placeholder="Telephone Number" value="{{ (old('telephonenumber')) ? old('telephonenumber') : '' }}" autocomplete="off" />
							@if($errors->has('telephonenumber'))
								<p class="text-danger">{{ $errors->first('telephonenumber') }}</p>
							@endif
						</div>
						<div class="col-lg-2">
							<input type="text" class="form-control input-lg" name="bandnumber" placeholder="Band Number" value="{{ (old('bandnumber')) ? old('bandnumber') : '' }}" autocomplete="off" />
							@if($errors->has('bandnumber'))
								<p class="text-danger">{{ $errors->first('bandnumber') }}</p>
							@endif
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-success btn-block"><i class="fa fa-user-check mr-2"></i>Check-in</button>
						</div>
					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</div>
		</div>

		<div class="row mt-5">

			<div class="col-md-6">

				<h1 class="text-center">{{ Visitor::thisYear()->count() }}<br><small>Visitors has checked-in</small></h1>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Telephone Number</th>
							<th>Band #</th>
							<th>Checked In</th>
						</tr>
					</thead>
					<tbody>
						@foreach($visitors as $visitor)	
							<tr>
								<td>{{ $visitor->fullname }}</td>
								<td>{{ $visitor->phonenumber }}</td>
								<td>{{ $visitor->bandnumber }}</td>
								<td><span data-toggle="tooltip" title="{{ $visitor->created_at }}">{{ $visitor->created_at->diffForHumans() }}</span></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			

		</div>

	</div>
</div>

@stop