@extends('layouts.main')
@section('title', trans('global.add').' '.trans('compo.teams'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('global.add') }} {{ trans('compo.teams') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo') }}">{{ trans('compo.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo-team') }}">{{ trans('compo.teams') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('global.add') }}</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('compo-team-store') }}">
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('compo.team.create.name') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" type="text" name="name" placeholder="{{ trans('compo.team.create.name') }}" value="{{ old('name') ?? '' }}">
						</div>
						@if($errors->has('name'))
							<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ trans('compo.team.create.players') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="form-label">{{ trans('compo.teamleader') }}</label>
						<input type="text" class="form-control" disabled="" value="{{ User::getFullnameAndNicknameByID(\Sentinel::check()->id) }}">
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('compo.player') }} 2</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ trans('global.pleaseselect') }} --</option>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('compo.player') }} 3</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ trans('global.pleaseselect') }} --</option>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('compo.player') }} 4</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ trans('global.pleaseselect') }} --</option>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('compo.player') }} 5</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ trans('global.pleaseselect') }} --</option>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> {{ trans('global.add') }}</button>
				</div>
			</div>
		</div>
	</form>
</div>

@stop
@section('javascript')
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
@stop