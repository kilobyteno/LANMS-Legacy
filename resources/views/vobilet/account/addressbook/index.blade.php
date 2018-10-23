@extends('layouts.main')
@section('title', 'Addressbook')
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">Addressbook <a class="btn btn-sm btn-success pull-right" href="{{ route('account-addressbook-create') }}"><i class="fa fa-plus"></i> Add</a></h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">User</li>
			<li class="breadcrumb-item active" aria-current="page">Addressbook</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			@if(Sentinel::getUser()->reservations->count() <> 0)
				<div class="alert alert-info" role="alert"><strong>Information!</strong> You will not be able to delete any addresses while you have reserved seats.</div>
			@endif
			@if($addresses->count() == 0)
				<blockquote>
					<p><em>We can't find any addresses tied to your account. You should <a href="{{ route('account-addressbook-create') }}">add</a> one.</em></p>
				</blockquote>
			@else
				<div class="row">
					<?php $i=0; ?>
					@foreach($addresses as $address)
						<?php $i++; ?>
						<div class="col-xl-4">
							<div class="card">
								<div class="card-header @if($address->main_address) bg-primary @endif br-tr-7 br-tl-7">
									<h3 class="card-title  @if($address->main_address) text-white @endif">Address #{{ $i }}</h3>
								</div>
								<div class="card-body">
									<address>
										<strong>{{ $address->address1 }}</strong>@if($address->address2), {{ $address->address2 }}@endif<br>
										{{ $address->postalcode }}, {{ $address->city }}<br>
										{{ $address->county }}<br>
										{{ $address->country }}
									</address>
								</div>
								<div class="card-footer">
									<a class="btn btn-sm btn-warning" href="{{ route('account-addressbook-edit', $address->id) }}"><i class="fas fa-edit"></i> Edit</a>
									@if(Sentinel::getUser()->reservations->count() == 0)
										<button id="address-destroy-{{ $address->id }}" class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i> Delete</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>
@stop

@section('javascript')
<script src="{{ Theme::url('js/vendors/sweetalert.min.js') }}"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		@if(Sentinel::getUser()->reservations->count() == 0)
			@foreach($addresses as $address)
				$("#address-destroy-{{ $address->id }}").click(function(){
					swal({
						title: "Delete Address: {{ $address->address1 }}",
						text: "Are you sure you want to delete this address?",
						icon: "error",
						buttons: ['No, take me away!', 'Yes, I want to delete it.'],
						closeOnClickOutside: false
					}).then((willDelete) => {
						if (willDelete) {
							window.location.replace("{{ route('account-addressbook-destroy', $address->id) }}");
						} else {
							swal({
								title: "Nothing has been done.",
								text: "The address was not deleted!",
								icon: "success",
							});
						}
					});
				});
			@endforeach
		@endif
	});
</script>
@stop