@extends('layouts.main')
@section('title', 'Reservations')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Reservations</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item">Account</li>
			<li class="breadcrumb-item active" aria-current="page">Reservations</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<div class="card">
				@if(count($reservations) == 0)
					<div class="card-body">
						<p><em>We can't find any data for you...</em></p>
					</div>
				@else
					<div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
							<thead>
								<th>ID</th>
								<th>Date</th>
								<th>Year</th>
								<th>Seat</th>
								<th>Reserved for</th>
								<th>Reserved by</th>
								<th>Details</th>
							</thead>
							<tbody>
								@foreach($reservations as $reservation)
									<tr>
										<td>{{ $reservation->id }}</td>
										<td>{{ date(User::getUserDateFormat(), strtotime($reservation->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($reservation->created_at)) }}</td>
										<td>{{ $reservation->year or 'N/A' }}</td>
										<td>{{ $reservation->seat->name or 'N/A' }}</td>
										<td>{{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</td>
										<td>{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}</td>
										<td><a href="{{ route('account-reservation-view', $reservation->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info"></i> View Reservation</a> @if($reservation->payment)<a href="{{ route('account-billing-payment', $reservation->payment->id) }}" class="btn btn-success btn-sm"><i class="fas fa-money-bill-alt"></i> View Payment</a>@endif</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop