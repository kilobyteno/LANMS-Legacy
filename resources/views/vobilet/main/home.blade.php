@extends('layouts.main')
@section('title', __('header.home'))
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 col-lg-8 col-sm-12">
			@foreach($news as $article)
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h3>
						<div class="card-options">
							<a href="{{ route('news-category-show', $article->category->slug) }}" class="badge badge-light"><i class="fas fa-tag mr-2"></i>{{ $article->category->name }}</a>
							@if(Sentinel::check())
								@if(Sentinel::hasAccess('admin.news.update'))
									<a href="{{ route('admin-news-edit', $article->id) }}" class="btn btn-warning btn-sm ml-2"><i class="fas fa-edit mr-2"></i>{{ __('global.edit') }}</a>
								@endif
							@endif
						</div>
					</div>
					<div class="card-body d-flex flex-column card-body-article">
						<div class="text-muted">{!! $article->content !!}</div>
					</div>
					<div class="card-footer">
						<div class="d-flex align-items-center">
							<div class="avatar brround avatar-md mr-3" style="background-image: url(@if($article->author->profilepicturesmall){{ $article->author->profilepicturesmall }} @else {{ '/images/profilepicture/0_small.png' }}@endif)"></div>
							<div> <a href="{{ URL::route('user-profile', $article->author->username) }}" class="text-default">{{ User::getFullnameByID($article->author->id) }}</a> <small class="d-block text-muted">{{ $article->published_at->diffForHumans() }}</small> </div>
							{{-- <div class="ml-auto text-muted"> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-thumbs-o-up"></i></a> </div> --}}
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<div class="col-md-12 col-lg-4 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title">{{ __('pages.home.info') }}</h2>
				</div>
				<div class="card-body">
					<p><b>{{ __('pages.home.where') }}: </b> @if(LANMS\Info::getContent('where_url')) {!! '<a href="'.LANMS\Info::getContent('where_url').'">'.LANMS\Info::getContent('where').'</a>' !!} @else {{ LANMS\Info::getContent('where') }} @endif</p>
					<p><b>{{ __('pages.home.when') }}: </b> {{ LANMS\Info::getContent('when') }}</p>
					<p><b>{{ __('pages.home.price') }}: </b> {{ LANMS\Info::getContent('price') }} <small><a class="float-right" href="{{ route('tickets') }}"><i class="fas fa-ticket-alt"></i> {{ __('pages.home.moreinfo') }}</a></small></p>
				</div>
			</div>
			@if(\LANMS\Info::where('name', 'social_discord_server_id')->where('content', '<>', '')->first())
				<div class="mb-4">
					<iframe src="https://discordapp.com/widget?id={{ \LANMS\Info::where('name', 'social_discord_server_id')->first()->content }}&theme=@if(Sentinel::check())@if(Sentinel::getUser()->theme == 'default'){{ 'light' }}@else{{ Sentinel::getUser()->theme }}@endif @else{{ 'light' }}@endif" height="300" allowtransparency="true" frameborder="0" style="width: 100%"></iframe>
				</div>
			@endif
			@if(Setting::get('MAIN_ENABLE_GRASROTANDELEN_WIDGET') && Setting::get('MAIN_ORGNR'))
				<div class="justify-content-center text-center mb-4">
					<iframe frameborder="0" scrolling="no" src="https://www.norsk-tipping.no/grasrotandelen/stats-iframe?title=lowercase#receiver={{ Setting::get('MAIN_ORGNR') }}" style="width: 100%; min-height: 500px; height: auto;" class="rounded"></iframe>
				</div>
			@endif
		</div>
		
	</div>
</div>

@stop