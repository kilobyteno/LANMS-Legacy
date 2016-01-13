@extends('layouts.main')
@section('title') Home @stop

@section('content')

<div class="container">

	<div class="row latest-posts">
		<div class="col s12">



			@foreach($news as $article)
				<div class="row post">
					<div class="col s12">
						<div class="card">
							<div class="card-content">
								<a href="{{ route('news-show', $article->slug) }}"><h1>{{ $article->title }}</h1></a>
								<p>{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif</p>
							</div>
							<div class="card-action">
								<small>Published: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a href="{{ URL::route('user-profile', User::getUsernameByID($article->author_id)) }}">{{ User::getFullnameByID($article->author_id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', User::getUsernameByID($article->author_id)) }}">{{ User::getFullnameByID($article->author_id) }}</a></small>
							@if(strlen($article->content) >= 1000)
								<a href="{{ URL::route('news-show', $article->slug) }}" class="btn btn-primary btn-xs pull-right newsBtn"><i class="fa fa-arrow-circle-right"></i> Les mer</a>
							@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach

			<br>
			<div class="row">
				<div class="col s12">
					<a href="#" class="btn btn-primary"><span class="fa fa-long-arrow-left"></span> Les eldre nyheter</a>
				</div>
			</div>

		</div>
	</div>

@endsection
