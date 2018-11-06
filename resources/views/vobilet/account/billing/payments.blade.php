@extends('layouts.main')
@section('title', 'Payments - Billing')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Payments</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">User</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">Account</a></li>
			<li class="breadcrumb-item">Billing</li>
			<li class="breadcrumb-item active" aria-current="page">Payments</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<div class="card">
				@if(count($payments) == 0)
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
								<th>Res. ID</th>
								<th>Details</th>
							</thead>
							<tbody>
								@foreach($payments as $payment)
									<tr>
										<td>{{ $payment->id }}</td>
										<td>{{ date(User::getUserDateFormat(), strtotime($payment->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($payment->created_at)) }}</td>
										<td>{{ $payment->reservation->year ?? 'N/A' }}</td>
										<td>{{ $payment->reservation->seat->name ?? 'N/A' }}</td>
										<td>@if($payment->reservation){{ User::getFullnameAndNicknameByID($payment->reservation->reservedfor->id) }}@else{{ 'N/A' }}@endif</td>
										<td>{{ $payment->reservation->id ?? 'N/A' }}</td>
										<td>@if($payment->reservation)<a href="{{ route('account-billing-payment', $payment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> View</a>@endif</td>
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