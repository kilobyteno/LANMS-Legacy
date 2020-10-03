@extends('layouts.main')
@section('title', __('user.profile.edit.settings.2fa.title'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="card" action="{{ route('account-2fa-verify') }}" method="post">
                <div class="card-header">
                    <h3 class="card-title">{{ __('user.profile.edit.settings.2fa.title') }}</h3>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="verification_code" class="col-form-label">{{ __('user.profile.edit.settings.2fa.desc') }}: {{ Sentinel::getUser()->phone }}</label>
                        <input id="verification_code" type="tel" class="form-control @error('verification_code') is-invalid @enderror" autocomplete="off" name="verification_code" value="{{ old('verification_code') }}" required>
                        @error('verification_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-double"></i> {{ __('global.verify') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection