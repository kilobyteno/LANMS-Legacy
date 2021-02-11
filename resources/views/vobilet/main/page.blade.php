@extends('layouts.main')
@section('title', $page->title)
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ $page->title }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
			<li class="breadcrumb-item">{{ __('header.information') }}</li>
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
				<div class="card-footer">
					{{ __('global.time.created') }}: {{ date(User::getUserDateFormat(), strtotime($page->created_at)) .' '.__('global.time.at').' '. date(User::getUserTimeFormat(), strtotime($page->created_at)) }} {{ __('global.by') }} <a href="{{ URL::route('user-profile', $page->author->username) }}">{{ User::getFullnameByID($page->author->id) }}</a> &middot; {{ __('global.time.updated') }}: {{ date(User::getUserDateFormat(), strtotime($page->updated_at))  .' '.__('global.time.at').' '. date(User::getUserTimeFormat(), strtotime($page->updated_at)) }} {{ __('global.by') }} <a href="{{ URL::route('user-profile', $page->editor->username) }}">{{ User::getFullnameByID($page->editor->id) }}</a>
					@if(Sentinel::check())
						@if(Sentinel::hasAccess('admin.pages.update'))
							<a href="{{ route('admin-pages-edit', $page->id) }}" class="btn btn-warning btn-sm float-right"><i class="fas fa-edit mr-2"></i>{{ __('global.edit') }}</a>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@stop