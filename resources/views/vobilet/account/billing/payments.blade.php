@extends('layouts.main')
@section('title', __('user.account.billing.payments.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('user.account.billing.payments.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
			<li class="breadcrumb-item">{{ __('user.account.billing.title') }}</li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('user.account.billing.payments.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<div class="card">
				@if(count($payments) == 0)
					<div class="card-body">
						<p><em>{{ __('global.nodata') }}</em></p>
					</div>
				@else
					<div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
							<thead>
								<th>{{ __('global.date') }}</th>
								<th>{{ __('global.year') }}</th>
								<th>{{ __('global.seat') }}</th>
								<th>{{ __('global.reservedfor') }}</th>
								<th>{{ __('global.details') }}</th>
							</thead>
							<tbody>
								@foreach($payments as $payment)
									<tr>
										<td>{{ ucfirst(\Carbon::parse($payment->created_at)->isoFormat('LLLL')) }}</td>
										<td>{{ $payment->reservation->year ?? 'N/A' }}</td>
										<td>{{ $payment->reservation->seat->name ?? 'N/A' }}</td>
										<td>@if($payment->reservation){{ User::getFullnameAndNicknameByID($payment->reservation->reservedfor->id) }}@else{{ 'N/A' }}@endif</td>
										<td>@if($payment->reservation)<a href="{{ route('account-billing-payment', $payment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ __('global.view') }}</a>@endif</td>
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