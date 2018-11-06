@extends('layouts.main')
@section('title', $page->title)
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ $page->title }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			<li class="breadcrumb-item">Information</li>
			<li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="text-wrap">
						{!! $page->content !!}
					</div>
				</div> 
				<div class="card-footer">Created: {{ date(User::getUserDateFormat(), strtotime($page->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($page->created_at)) }} by <a href="{{ URL::route('user-profile', $page->author->username) }}">{{ User::getFullnameByID($page->author->id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($page->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($page->updated_at)) }} by <a href="{{ URL::route('user-profile', $page->editor->username) }}">{{ User::getFullnameByID($page->editor->id) }}</a></div>
			</div>
		</div>
	</div>
</div>

@stop