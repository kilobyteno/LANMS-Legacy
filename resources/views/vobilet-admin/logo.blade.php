@extends('layouts.main')
@section('title', 'Logo - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Upload logo</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item">System</li>
		<li class="breadcrumb-item active" aria-current="page">Logo</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12">

		<form class="card" action="{{ route('admin-logo-dark') }}" method="post" enctype="multipart/form-data">
			<div class="card-body">

				<div class="row">

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Dark logo on light background</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="logo_dark">
								<label class="custom-file-label">{{ __('global.choosefile') }}</label>
							</div>
							@if($errors->has('logo_dark'))
								<p class="text-danger">{{ $errors->first('logo_dark') }}</p>
							@endif
						</div>
					</div>

                    <div class="col-sm-3 bg-white">
                        <p>Current logo</p>
                        <img src="{{ asset(Setting::get("WEB_LOGO_DARK")) }}" class="img-fluid" />
                    </div>

				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Upload</button>
			</div>
		</form>

		<form class="card" action="{{ route('admin-logo-light') }}" method="post" enctype="multipart/form-data">
			<div class="card-body">

				<div class="row">

					<div class="col-sm-3">
						<div class="form-group">
							<label class="form-control-label">Light logo on dark background</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="logo_light">
								<label class="custom-file-label">{{ __('global.choosefile') }}</label>
							</div>
							@if($errors->has('logo_light'))
								<p class="text-danger">{{ $errors->first('logo_light') }}</p>
							@endif
						</div>
					</div>

                    <div class="col-sm-3 bg-azure-darker">
                        <p class="text-white">Current logo</p>
                        <img src="{{ asset(Setting::get("WEB_LOGO_LIGHT")) }}" class="img-fluid" />
                    </div>

				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Upload</button>
			</div>
		</form>
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
