@extends('layouts.main')
@section('title', 'Payments - Billing')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Payments</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li>Billing</li>
				<li class="active"><strong>Payments</strong></li>
			</ol>

			<table class="table">
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
							<td>{{ $payment->reservation->year }}</td>
							<td>{{ $payment->reservation->seat->name }}</td>
							<td>{{ User::getFullnameAndNicknameByID($payment->reservation->reservedfor->id) }}</td>
							<td>{{ $payment->reservation->id }}</td>
							<td><a href="{{ route('account-billing-payment', $payment->id) }}" class="btn btn-info btn-xs btn-icon icon-left"><i class="fa fa-info-circle"></i>View</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop