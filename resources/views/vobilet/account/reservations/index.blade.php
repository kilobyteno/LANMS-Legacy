@extends('layouts.main')
@section('title', __('user.account.reservations.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('user.account.reservations.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('user.account.reservations.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<div class="card">
				@if(count($reservations) == 0)
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
								<th>{{ __('global.reservedby') }}</th>
								<th>{{ __('global.details') }}</th>
							</thead>
							<tbody>
								@foreach($reservations as $reservation)
									<tr>
										<td>{{ ucfirst(\Carbon::parse($reservation->created_at)->isoFormat('LLLL')) }}</td>
										<td>{{ $reservation->year ?? 'N/A' }}</td>
										<td>{{ $reservation->seat->name ?? 'N/A' }}</td>
										<td>{{ User::getFullnameAndNicknameByID($reservation->reservedfor_id) }}</td>
										<td>{{ User::getFullnameAndNicknameByID($reservation->reservedby_id) }}</td>
										<td><a href="{{ route('account-reservation-view', $reservation->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info"></i> {{ __('user.account.reservations.viewreservation') }}</a> @if($reservation->payment)<a href="{{ route('account-billing-payment', $reservation->payment->id) }}" class="btn btn-success btn-sm"><i class="fas fa-money-bill-alt"></i> {{ __('user.account.reservations.viewpayment') }}</a>@endif</td>
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