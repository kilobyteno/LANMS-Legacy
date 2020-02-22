@extends('layouts.main')
@section('title', trans('user.gdpr.message.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.gdpr.message.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.gdpr.message.title') }}</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('user.gdpr.message.question') }}</h3>
                    <div class="card-options">
                        <form class="form-inline" role="form" method="POST" action="{{ route('gdpr-terms-accepted') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success"><i class="fas fa-vote-yea"></i> {{ trans('user.gdpr.message.iconsent') }}</button>
                        </form>
                        <form class="form-inline ml-3" role="form" method="POST" action="{{ route('gdpr-terms-denied') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-times"></i> {{ trans('user.gdpr.message.ideny') }}</button>
                        </form>
                    </div>
                    
                </div>
				<div class="card-body">
					{!! trans('user.gdpr.message.agreement') !!}
				</div>
			</div>
		</div>
	</div>
</div>

@stop