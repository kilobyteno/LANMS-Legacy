@extends('layouts.main')
@section('title', __('user.gdpr.delete.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ __('user.gdpr.delete.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('user.gdpr.delete.title') }}</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-12">
			<form class="card" role="form" method="post" action="{{ route('account-gdpr-delete-post') }}">
				<div class="card-body">
					{!! __('user.gdpr.delete.message', ['url' => route('account-gdpr-download')]) !!}
					<div class="form-group @if($errors->has('password')) has-error @endif">
						<label class="form-label">{{ __('user.gdpr.delete.password') }}:</label>
						<div class="input-group">
							<input class="form-control" type="password" name="password">
						</div>
						@if($errors->has('password'))
							<p class="text-danger">{{ $errors->first('password') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-6">
							<label class="custom-switch">
								<input type="checkbox" class="custom-switch-input" name="accept_deletion">
								<span class="custom-switch-indicator"></span>
								<span class="custom-switch-description">{{ __('user.gdpr.delete.iamsure') }}</span>
							</label>
							@if($errors->has('accept_deletion'))
								<p class="text-danger">{{ $errors->first('accept_deletion') }}</p>
							@endif
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> {{ __('user.gdpr.delete.button') }}</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@stop