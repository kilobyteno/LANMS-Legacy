@extends('layouts.main')
@section('title', 'Address Book')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
			<h2>Address Book<a class="btn btn-sm btn-success pull-right" href="{{ route('account-addressbook-create') }}"><i class="fa fa-plus"></i> Add</a></h2>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li class="active"><strong>Address Book</strong></li>
			</ol>

			<div class="row">
				<div class="col-lg-12">
					@if($addresses->count() == 0)
						<blockquote>
							<p><em>We can't find any addresses tied to your account. You should <a href="{{ route('account-addressbook-create') }}">add</a> one.</em></p>
						</blockquote>
					@else
						<?php $i=0; ?>
						@foreach($addresses as $address)
							<?php $i++; ?>
							<div class="col-lg-3">
								<div class="panel @if($address->primary) panel-info @else panel-default @endif">
									<div class="panel-heading">
										<h3 class="panel-title">Address #{{ $i }}@if($address->primary) <small>Primary</small>@endif</h3>
									</div>
									<div class="panel-body">
										<address>
											<strong>{{ $address->address1 }}</strong>@if($address->address2), {{ $address->address2 }}@endif<br>
											{{ $address->postalcode }}, {{ $address->city }}<br>
											{{ $address->county }}<br>
											{{ $address->country }}
										</address>
										<p>
											<a class="btn btn-xs btn-warning" href="{{ route('account-addressbook-edit', $address->id) }}"><i class="fa fa-pencil"></i> Edit</a>
											<a class="btn btn-xs btn-danger" href=""><i class="fa fa-times"></i> Delete</a>
										</p>
									</div>
								</div>
							</div>
						@endforeach

					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop