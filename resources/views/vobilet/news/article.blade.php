@extends('layouts.main')
@section('title', $article->title.' - '.trans('header.news'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('header.news') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ route('news') }}">{{ trans('header.news') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="card"> 
				<div class="card-header">
					<h3 class="card-title"><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h3>
					<div class="card-options">
						<a href="{{ route('news-category-show', $article->category->slug) }}" class="badge badge-light"><i class="fas fa-tag mr-2"></i>{{ $article->category->name }}</a>
						@if(Sentinel::check())
							@if(Sentinel::hasAccess('admin.news.update'))
								<a href="{{ route('admin-news-edit', $article->id) }}" class="btn btn-warning btn-sm ml-2"><i class="fas fa-edit mr-2"></i>{{ trans('global.edit') }}</a>
							@endif
						@endif
					</div>
				</div>
				<div class="card-body d-flex flex-column">
					<div class="text-muted">{!! $article->content !!}</div>
					<div class="d-flex align-items-center pt-5 mt-auto">
						<div class="avatar brround avatar-md mr-3" style="background-image: url(@if($article->author->profilepicturesmall){{ $article->author->profilepicturesmall }} @else {{ '/images/profilepicture/0_small.png' }}@endif)"></div>
						<div> <a href="{{ URL::route('user-profile', $article->author->username) }}" class="text-default">{{ User::getFullnameByID($article->author->id) }}</a> <small class="d-block text-muted">{{ $article->published_at->diffForHumans() }}</small> </div>
						{{-- <div class="ml-auto text-muted"> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-thumbs-o-up"></i></a> </div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop