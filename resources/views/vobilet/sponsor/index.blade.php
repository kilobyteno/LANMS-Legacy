@extends('layouts.main')
@section('title', trans('header.sponsor'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('header.sponsor') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('header.sponsor') }}</li>
		</ol>
	</div>
	<div class="row">
		@if(count(LANMS\Sponsor::thisYear()->get()) > 0)
			@foreach(LANMS\Sponsor::ordered()->thisYear()->get() as $sponsor)
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-body d-flex flex-column">
							<h4><a href="{{ $sponsor->url }}">{{ $sponsor->name }}</a></h4>
							@if($sponsor->description)<div class="text-muted">{{ $sponsor->description }}</div>@endif
						</div>
						<a href="{{ $sponsor->url }}"><img class="card-img-top br-br-7 br-bl-7" src="@if(Sentinel::check()){{ (Sentinel::getUser()->theme == 'dark') ? ($sponsor->image_light) : asset($sponsor->image_dark) }} @else {{ $sponsor->image_dark }}@endif" alt="{{ $sponsor->name }}"></a> 
					</div>
				</div>
			@endforeach
		@else
			<div class="col-md-12 col-lg-12 col-sm-12">
				<p>{{ trans('global.nodata') }}</p>
			</div>
		@endif
	</div>
</div>

@stop