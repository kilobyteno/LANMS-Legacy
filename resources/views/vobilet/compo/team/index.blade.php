@extends('layouts.main')
@section('title', trans('compo.teams'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('compo.teams') }}<a class="btn btn-sm btn-success ml-2" href="{{ route('compo-team-create') }}"><i class="fa fa-plus mr-2"></i> {{ trans('global.add') }}</a></h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('compo') }}">{{ trans('compo.title') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('compo.teams') }}</li>
		</ol>
	</div>
	<div class="row">
		@if(count($teams) > 0)
			@foreach($teams as $team)
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">{{ $team->name }}</h3>
						</div>
						<div class="card-body d-flex flex-column">
							<a href="{{ URL::route('user-profile', $team->leader->username) }}" data-toggle="tooltip" data-placement="left" title="{{ trans('compo.teamleader') }}"><i class="fas fa-user mr-2"></i>{{ User::getFullnameAndNicknameByID($team->leader->id) }}</a>
							@foreach($team->players as $player)
								<a href="{{ URL::route('user-profile', $player->username) }}"><i class="far fa-user mr-2"></i>{{ User::getFullnameAndNicknameByID($player->id) }}</a>
							@endforeach
						</div>
						<div class="card-footer">
							<a href="{{ route('compo-team-edit', $team->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-1"></i>{{ trans('global.edit') }}</a>
							@if($team->composignups()->count() == 0)<a href="javascript:;" onclick="jQuery('#team-destroy-{{ $team->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-1"></i>{{ trans('global.delete') }}</a>@else <br><br><span class="badge badge-danger">{{ trans('compo.team.alert.cantdelete') }}</span>@endif
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="col-md-12 col-lg-12 col-sm-12">
				<p>{{ trans('global.nodata') }}</p>
			</div>
		@endif
	</div>
</div>


@foreach($teams as $team)
	<div class="modal fade" id="team-destroy-{{ $team->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>{{ trans('compo.team.delete.title') }}:</strong> #{{ $team->id }} - {{ $team->name }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>{{ trans('compo.team.delete.question') }}</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('compo-team-destroy', $team->id) }}" class="btn btn-danger">{{ trans('compo.team.delete.yes') }}</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">{{ trans('compo.team.delete.no') }}</button>
				</div>
			</div>
		</div>
	</div>
@endforeach

@stop