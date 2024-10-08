@extends('layouts.main')
@section('title', __('user.gdpr.download.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ __('user.gdpr.download.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('user.gdpr.download.title') }}</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-12">
			<form class="card" role="form" method="post" action="{{ route('gdpr-download') }}">
				<div class="card-body">
					<p>{{ __('user.gdpr.download.message') }}</p>

					<div class="form-group @if($errors->has('password')) has-error @endif">
						<label class="form-label">{{ __('global.password') }}</label>
						<div class="input-group">
							<input class="form-control" type="password" name="password">
						</div>
						@if($errors->has('password'))
							<p class="text-danger">{{ $errors->first('password') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-download"></i> {{ __('global.download') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>

@stop