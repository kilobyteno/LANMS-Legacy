@extends('layouts.main')
@section('title', 'Verify Phone')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Verify Phone</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">Verify Phone</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('account-verifycode') }}">
		<div class="col-lg-4">
			<div class="alert alert-primary" role="alert">
				<i class="fas fa-info mr-2" aria-hidden="true"></i>Verification token has been sent! Please wait up to one minute.
			</div>
			<div class="card">
				<div class="card-body">
					<div class="form-group @if ($errors->has('code')) has-error @endif">
						<label class="form-label">Type in the code you received on a SMS:</label>
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
					<button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> Verify</button>
				</div>
			</div>
			
		</div>
	</form>
</div>
@stop