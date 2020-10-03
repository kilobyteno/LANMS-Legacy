@extends('layouts.main')
@section('title', __('global.notification.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('global.notification.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('global.notification.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				@if(Sentinel::getUser()->unreadNotifications->count() > 1)
					<div class="card-header">
						<div class="card-options"><a href="{{ route('user-notifications-dismissall') }}" class="btn btn-info">{{ __('global.notification.dismissall') }}</a></div>
					</div>
				@endif
				<div class="table-responsive">
					<table class="table card-table table-vcenter">
						<thead>
							<tr>
								<th>{{ __('global.notification.time') }}</th>
								<th>{{ __('global.notification.message') }}</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($notifications as $notification)
								<tr @if($notification->read_at)class="bg-light text-dark"@endif>
									<td>{{ $notification->created_at->diffForHumans() }}</td>
									<td>
										@if($notification->type === 'LANMS\Notifications\InvoiceUnpaid')
											<i class="fas fa-exclamation mr-2 text-danger"></i> {{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['date' => ucfirst(\Carbon::parse($notification->data['due_date'])->isoFormat('LL')), 'amount' => moneyFormat(floatval($notification->data['amount_due']/100), strtoupper($notification->data['currency']))]) }}
											</div>
										@elseif($notification->type === 'LANMS\Notifications\SeatReservationExpires')
											<i class="fas fa-chair mr-2 text-warning"></i> {{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['seatname' => strtoupper($notification->data['id'])]) }}
											</div>
										@elseif($notification->type === 'LANMS\Notifications\SeatReservationExpired')
											<i class="fas fa-chair mr-2 text-danger"></i> {{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['seatname' => strtoupper($notification->data['id'])]) }}
											</div>
										@elseif($notification->type === 'LANMS\Notifications\CompoTeamAdded' || $notification->type === 'LANMS\Notifications\CompoTeamRemoved')
											<i class="fas fa-user-shield mr-2 text-info"></i> {{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['team' => $notification->data['teamname'], 'user' => $notification->data['user']]) }}
											</div>
										@else
											<i class="fas fa-info mr-2"></i> {{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1))) }}
										@endif
									</td>
									<td>@if(!$notification->read_at)<a class="btn btn-secondary btn-sm" href="{{ route('user-notification-dismiss', $notification->id) }}">{{ __('global.notification.dismiss') }}</a>@endif</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			{{ $notifications->links('layouts.pagination') }}
		</div>
	</div>
</div>

@stop