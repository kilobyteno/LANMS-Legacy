@extends('layouts.main')
@section('title', __('user.profile.changeimages.title'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('user.profile.changeimages.title') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('account') }}">{{ __('user.account.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('user-profile', Sentinel::getUser()->username) }}">{{ __('user.profile.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('user.profile.changeimages.title') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-profile" style="background: url({{ $profilecover ?? '/images/profilecover/0.jpg' }}); background-size:cover;">
				<div class="card-body text-center">
					<img class="card-profile-img" src="{{ $profilepicture ?? '/images/profilepicture/0.png' }}">
					<h3 class="mb-3 text-white">{{ $firstname }}@if($showname) {{ $lastname }}@endif</h3>
					@if(Sentinel::findById($id)->inRole('admin') || Sentinel::findById($id)->inRole('superadmin') || Sentinel::findById($id)->inRole('moderator'))
						<p class="mb-4 text-white">{{ __('global.staff') }}</p>
					@else
						<p class="mb-4 text-white">{{ __('global.member') }}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<form class="card" role="form" method="post" action="{{ route('account-change-image-profile-post') }}" enctype="multipart/form-data">
				@if($errors->has('profileimage'))<div class="card-status bg-red br-tr-7 br-tl-7"></div>@endif
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.changeimages.profilephoto') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group ">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="profileimage">
							<label class="custom-file-label">{{ __('global.choosefile') }}</label>
						</div>
						@if($errors->has('profileimage'))
							<p class="text-danger">{{ $errors->first('profileimage') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> {{ __('user.profile.changeimages.button') }}</button>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<form class="card" role="form" method="post" action="{{ route('account-change-image-cover-post') }}" enctype="multipart/form-data">
				@if($errors->has('profilecover'))<div class="card-status bg-red br-tr-7 br-tl-7"></div>@endif
				<div class="card-header">
					<h3 class="card-title">{{ __('user.profile.changeimages.coverphoto') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="profilecover">
							<label class="custom-file-label">{{ __('global.choosefile') }}</label>
						</div>
						@if($errors->has('profilecover'))
							<p class="text-danger">{{ $errors->first('profilecover') }}</p>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> {{ __('user.profile.changeimages.button') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$('.custom-file-input').on('change', function() { 
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName); 
		});
	</script>
@stop