@extends('layouts.main')
@section('title', trans('header.home'))
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 col-lg-9 col-sm-12">
			@foreach($news as $article)
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h3>
						<div class="card-options">
							@if(Sentinel::check())
								@if(Sentinel::hasAccess('admin.news.update'))
									<a href="{{ route('admin-news-edit', $article->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>{{ trans('global.edit') }}</a>
								@endif
							@endif
						</div>
					</div>
					<div class="card-body d-flex flex-column">
						<div class="text-muted">{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif</div>
						<div class="d-flex align-items-center pt-5 mt-auto">
							<div class="avatar brround avatar-md mr-3" style="background-image: url(@if($article->author->profilepicturesmall){{ $article->author->profilepicturesmall }} @else {{ '/images/profilepicture/0_small.png' }}@endif)"></div>
							<div> <a href="{{ URL::route('user-profile', $article->author->username) }}" class="text-default">{{ User::getFullnameByID($article->author->id) }}</a> <small class="d-block text-muted">{{ $article->published_at->diffForHumans() }}</small> </div>
							{{-- <div class="ml-auto text-muted"> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-thumbs-o-up"></i></a> </div> --}}
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<div class="col-md-12 col-lg-3  col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title">{{ trans('pages.home.info') }}</h2>
				</div>
				<div class="card-body">
					<p><b>{{ trans('pages.home.where') }}: </b> @if(LANMS\Info::getContent('where_url')) {!! '<a href="'.LANMS\Info::getContent('where_url').'">'.LANMS\Info::getContent('where').'</a>' !!} @else {{ LANMS\Info::getContent('where') }} @endif</p>
					<p><b>{{ trans('pages.home.when') }}: </b> {{ LANMS\Info::getContent('when') }}</p>
					<p><b>{{ trans('pages.home.price') }}: </b> {{ LANMS\Info::getContent('price') }}@if(LANMS\Info::getContent('price_alt')&&LANMS\Info::getContent('price_alt')!=LANMS\Info::getContent('price')) {!! '<small><em>('.LANMS\Info::getContent('price_alt').')</em></small>' !!}@endif</p>
				</div>
			</div>
			@if(\LANMS\Info::where('name', 'social_discord_server_id')->where('content', '<>', '')->first())
				<div class="mb-4">
					<iframe src="https://discordapp.com/widget?id={{ \LANMS\Info::where('name', 'social_discord_server_id')->first()->content }}&theme=@if(Sentinel::check())@if(Sentinel::getUser()->theme == 'default'){{ 'light' }}@else{{ Sentinel::getUser()->theme }}@endif @else{{ 'light' }}@endif" height="300" allowtransparency="true" frameborder="0" style="width: 100%"></iframe>
				</div>
			@endif
			@if(count(LANMS\Sponsor::thisYear()->get()) > 0)
				<h4>{{ trans('header.sponsor') }}</h4>
				@foreach(LANMS\Sponsor::ordered()->thisYear()->get() as $sponsor)
					<div class="card">
						<div class="card-body d-flex flex-column">
							<h4><a href="{{ $sponsor->url }}">{{ $sponsor->name }}</a></h4>
							@if($sponsor->description)<div class="text-muted">{{ $sponsor->description }}</div>@endif
						</div>
						<a href="{{ $sponsor->url }}"><img class="card-img-top br-br-7 br-bl-7" src="{{ asset($sponsor->image) }}" alt="{{ $sponsor->name }}"></a> 
					</div>
				@endforeach
			@endif
		</div>
		
	</div>
</div>

@stop