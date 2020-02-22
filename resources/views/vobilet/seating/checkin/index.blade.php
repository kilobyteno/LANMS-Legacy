@extends('layouts.main')
@section('title', trans('seating.checkin.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('seating.checkin.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('seating') }}">{{ trans('header.seating') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('seating.checkin.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-profile " style="background: url({{ '/images/profilecover/0.jpg' }}); background-size:cover;min-height: 300px">
				<div class="card-body text-center">
					<div class="d-flex flex-row align-items-center justify-content-center" style="min-height: 300px">
						<div class="col-6">
							<h3 class="text-white">{{ trans('seating.checkin.subtitle') }}</h3>
							<div class="input-group">
								<input type="text" class="form-control br-tl-7 br-bl-7" placeholder="">
								<div class="input-group-append ">
									<button type="button" class="btn btn-primary br-tr-7 br-br-7">
										<i class="fa fa-search" aria-hidden="true"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop