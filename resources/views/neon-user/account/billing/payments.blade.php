@extends('layouts.main')
@section('title', 'Payments - Billing')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li>Billing</li>
				<li class="active"><strong>Payments</strong></li>
			</ol>

			<table class="table">
				<thead>
					<th>Date</th>
					<th>Amount</th>
					<th>Currency</th>
					<th>Cardnumber</th>
					<th>Exp.</th>
					<th>Paid</th>
					<th>Refunded</th>
					<th>Status</th>
				</thead>
				<tbody>
					@foreach($payments as $payment)
						<tr>
							<td>{{ date(User::getUserDateFormat(), $payment['created']) .' at '. date(User::getUserTimeFormat(), $payment['created']) }}</td>
							<td>{{ $payment['amount'] }}</td>
							<td>{{ strtoupper($payment['currency']) }}</td>
							<td><em>xxxx xxxx xxxx</em> {{ $payment['source']['last4'] }}</td>
							<td>{{ $payment['source']['exp_month'] }} / {{ $payment['source']['exp_year'] }}</td>
							<td>{{ ($payment['paid'] ? "Yes" : "No") }}</td>
							<td>{{ ($payment['refunded'] ? "Yes - ".$payment['amount_refunded']." ".strtoupper($payment['currency']) : "No") }}</td>
							<td>
								@if($payment['failure_message'])
									<a href="javascript(void(0));" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $payment['failure_message'] }}" data-original-title="Failure Message">Failure</a>
								@else
									{{ ucfirst($payment['status']) }}
									<a href="javascript(void(0));" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $payment['failure_message'] }}" data-original-title="Failure Message">Failure</a>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop