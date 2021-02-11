@extends('layouts.main')
@section('title', __('global.edit').' '.__('compo.teams'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ __('global.edit') }} {{ __('compo.teams') }} #{{ $team->id }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo') }}">{{ __('compo.title') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo-team') }}">{{ __('compo.teams') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('global.edit') }} {{ __('compo.teams') }}</li>
		</ol>
	</div>
	<form class="row" role="form" method="post" action="{{ route('compo-team-update', $team->id) }}">
		<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ __('compo.team.create.name') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" type="text" name="name" placeholder="{{ __('compo.team.create.name') }}" value="{{ old('name') ?? $team->name }}">
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
					<h3 class="card-title">{{ __('compo.team.create.players') }}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="form-label">{{ __('compo.teamleader') }}</label>
						<input type="text" class="form-control" disabled="" value="{{ User::getFullnameAndNicknameByID(\Sentinel::check()->id) }}">
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('compo.player') }} 2</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ __('global.pleaseselect') }} --</option>
							@foreach(\User::active()->except(\Sentinel::getUser()->id) as $user)
								<option value="{{ $user->id }}" @if($team->players->count() >= 1) @if($team->players->offsetGet(0)->id == $user->id) selected="" @endif @endif>{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('compo.player') }} 3</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ __('global.pleaseselect') }} --</option>
							@foreach(\User::active()->except(\Sentinel::getUser()->id) as $user)
								<option value="{{ $user->id }}" @if($team->players->count() >= 2) @if($team->players->offsetGet(1)->id == $user->id) selected="" @endif @endif>{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('compo.player') }} 4</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ __('global.pleaseselect') }} --</option>
							@foreach(\User::active()->except(\Sentinel::getUser()->id) as $user)
								<option value="{{ $user->id }}"  @if($team->players->count() >= 3) @if($team->players->offsetGet(2)->id == $user->id) selected="" @endif @endif>{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('compo.player') }} 5</label>
						<select name="players[]" class="select2">
							<option value="">-- {{ __('global.pleaseselect') }} --</option>
							@foreach(\User::active()->except(\Sentinel::getUser()->id) as $user)
								<option value="{{ $user->id }}" @if($team->players->count() >= 4) @if($team->players->offsetGet(3)->id == $user->id) selected="" @endif @endif>{{ User::getFullnameAndNicknameByID($user->id) }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> {{ __('global.savechanges') }}</button>
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