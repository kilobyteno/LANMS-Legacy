@extends('layouts.main')
@section('title', $article->title.' - News')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">News</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">News</li>
			<li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="card"> 
				<div class="card-body d-flex flex-column">
					<h4><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h4>
					<div class="text-muted">{!! $article->content !!}</div>
					<div class="d-flex align-items-center pt-5 mt-auto">
						<div class="avatar brround avatar-md mr-3" style="background-image: url(@if($article->author->profilepicturesmall){{ $article->author->profilepicturesmall }} @else {{ '/images/profilepicture/0_small.png' }}@endif)"></div>
						<div> <a href="{{ URL::route('user-profile', $article->author->username) }}" class="text-default">{{ User::getFullnameByID($article->author->id) }}</a> <small class="d-block text-muted">{{ $article->published_at->diffForHumans() }}</small> </div>
						<div class="ml-auto text-muted"> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a> <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-thumbs-o-up"></i></a> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop