@extends('layouts.main')
@section('title', __('header.tickets'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('header.tickets') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('header.tickets') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="row shop-dec">
				@if(!$ticket_types->count())
					<div class="alert alert-info"><i class="fas fa-info mr-2" aria-hidden="true"></i>{{ __('pages.tickets.none') }}</div>
				@endif
				@foreach($ticket_types as $type)
					<div class="col-lg-6">
						<div class="card card-item">
							<div class="card-body">
								<div class="border p-0">
									<div class="row">
										<div class="col-md-4 pr-0">
											<div class="text-center p-5" style="background-color: #{{ $type->color }}">
												<img src="{{ $type->image ?? Theme::url('images/profilepicture/0.png') }}" class="img-fluid">
											</div>
										</div>
										<div class="col-md-8 pl-0">
											<div class="card-body cardbody">
												<div class="cardtitle">
													<a class="card-title">{{ $type->name }}</a>
												</div>
												<div class="cardprice">
													<span>{{ $type->price == 0 ? __('pages.tickets.free') : moneyFormat($type->price, Setting::get('MAIN_CURRENCY')) }}</span>
												</div>
											</div>
											<div class="card-body p-4">{!! $type->description !!}</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@stop