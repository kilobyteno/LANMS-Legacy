@extends('layouts.main')
@section('title', 'Download Personal Data')
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">Download Personal Data</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Account</li>
            <li class="breadcrumb-item active" aria-current="page">Download Personal Data</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-12">
			<form class="card" role="form" method="post" action="{{ route('gdpr-download') }}">
				<div class="card-body">
					<p>To download all your personal data you need to confirm your password.</p>

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
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-download"></i> Download</button>
				</div>
			</form>
		</div>
	</div>
</div>

@stop