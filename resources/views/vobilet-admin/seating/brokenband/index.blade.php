@extends('layouts.main')
@section('title', 'Broken Bands - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Broken Bands</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Broken Bands</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('admin-seating-brokenband-check') }}" method="post">
							<div class="input-group">
								<input type="text" class="form-control input-lg" name="band_id" placeholder="Band ID" value="{{ (old('band_id')) ? old('band_id') : '' }}" autocomplete="off" autofocus />
								<span class="input-group-append">
									<button type="submit" class="btn btn-success btn-block"><i class="fas fa-search mr-2"></i>Find Band</button>
								</span>
							</div>
							@if($errors->has('band_id'))
								<p class="text-danger">{{ $errors->first('band_id') }}</p>
							@endif
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
				<h1 class="text-center">{{ BrokenBand::thisYear()->count() }}<br><small>Broken bands this year</small></h1>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>checkin id</th>
							<th>previous bandnumber</th>
							<th>new bandnumber</th>
							<th>changed</th>
						</tr>
					</thead>
					<tbody>
						@foreach($brokenbands as $brokenband)	
							<tr>
								<td>{{ $brokenband->checkin_id }}</td>
								<td>{{ $brokenband->previous_bandnumber }}</td>
								<td>{{ $brokenband->new_bandnumber }}</td>
								<td><span data-toggle="tooltip" title="{{ $brokenband->created_at }}">{{ $brokenband->created_at->diffForHumans() }}</span></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

@stop