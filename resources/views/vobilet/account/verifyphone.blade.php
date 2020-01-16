@extends('layouts.main')
@section('title', trans('user.account.verifyphone.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('user.account.verifyphone.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.verifyphone.title') }}</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('account-verifycode') }}">
		<div class="col-lg-4">
			<div class="alert alert-primary" role="alert">
				<i class="fas fa-info mr-2" aria-hidden="true"></i>{{ trans('user.account.verifyphone.alert.info') }}
			</div>
			<div class="card">
				<div class="card-body">
					<div class="form-group @if ($errors->has('code')) has-error @endif">
						<label class="form-label">{{ trans('user.account.verifyphone.typecode') }}:</label>
						<div class="input-group">
							<input class="form-control" type="text" name="code" autocomplete="off">
						</div>
						@if($errors->has('code'))
							<p class="text-danger">{{ $errors->first('code') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> {{ trans('user.account.verifyphone.button') }}</button>
				</div>
			</div>
			
		</div>
	</form>
</div>
@stop