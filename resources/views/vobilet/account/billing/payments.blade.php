@extends('layouts.main')
@section('title', trans('user.account.billing.payments.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('user.account.billing.payments.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
			<li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.payments.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<div class="card">
				@if(count($payments) == 0)
					<div class="card-body">
						<p><em>{{ trans('global.nodata') }}</em></p>
					</div>
				@else
					<div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
							<thead>
								<th>{{ trans('global.date') }}</th>
								<th>{{ trans('global.year') }}</th>
								<th>{{ trans('global.seat') }}</th>
								<th>{{ trans('global.reservedfor') }}</th>
								<th>{{ trans('global.details') }}</th>
							</thead>
							<tbody>
								@foreach($payments as $payment)
									<tr>
										<td>{{ date(User::getUserDateFormat(), strtotime($payment->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($payment->created_at)) }}</td>
										<td>{{ $payment->reservation->year ?? 'N/A' }}</td>
										<td>{{ $payment->reservation->seat->name ?? 'N/A' }}</td>
										<td>@if($payment->reservation){{ User::getFullnameAndNicknameByID($payment->reservation->reservedfor->id) }}@else{{ 'N/A' }}@endif</td>
										<td>@if($payment->reservation)<a href="{{ route('account-billing-payment', $payment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ trans('global.view') }}</a>@endif</td>
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