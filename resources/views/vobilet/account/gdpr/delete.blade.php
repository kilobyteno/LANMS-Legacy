@extends('layouts.main')
@section('title', 'Delete Personal Data')
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">Delete Personal Data</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Account</li>
            <li class="breadcrumb-item active" aria-current="page">Delete Personal Data</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-12">
			<form class="card" role="form" method="post" action="{{ route('account-gdpr-delete-post') }}">
				<div class="card-body">
					<p>We are sorry to see you go!</p>
					<p>When clicking the delete button your account and all its data will be deleted forever. It will not be able to recover any data attached to this account.</p>
					<p>Make sure you <a href="{{ route('account-gdpr-download') }}">download your data</a> before you delete your account.</p>
					<div class="form-group @if($errors->has('password')) has-error @endif">
						<label class="form-label">Password</label>
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
								<input type="checkbox" class="custom-switch-input" name="accepted">
								<span class="custom-switch-indicator"></span>
								<span class="custom-switch-description">Yes, I am sure I want to delete my account!</span>
							</label>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@stop