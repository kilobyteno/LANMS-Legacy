@extends('layouts.main')
@section('title', 'Reserve Seat: '.$currentseat->name.' - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Reserve Seat</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">Seating</li>
		<li class="breadcrumb-item active" aria-current="page">Reserve Seat: {{ $currentseat->name }}</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				@include('seating.seatmap')
			</div>
			<div class="col-md-8">
				<form class="card" method="post" action="{{ route('admin-seating-reservation-reserve', $currentseat->slug) }}">
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">Reserved for:</label>
							<select name="reservedfor" class="select2">
								@foreach(\User::orderBy('lastname', 'asc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->get() as $user)
									<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
								@endforeach
							</select>
							@if($errors->has('reservedfor'))
								<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
							@endif
						</div>
					</div>
					<div class="card-footer">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button class="btn btn-success" type="submit"><i class="fas fa-hand-paper mr-2"></i>Reserve Seat</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@stop
@section('javascript')
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
@stop