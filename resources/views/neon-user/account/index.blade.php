@extends('layouts.main')
@section('title', 'Account')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Account</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="active"><strong>Account</strong></li>
			</ol>
			<div class="row">
				<div class="col-lg-4">

					<h3>Account Details</h3>
					<div class="list-group">
						<a href="{{ route('account-change-details') }}" class="list-group-item"><i class="fa fa-edit"></i> Edit Profile Details</a>
						<a href="{{ route('account-change-images') }}" class="list-group-item"><i class="fa fa-picture-o"></i> Change Profile Images</a>
						<a href="{{ route('account-addressbook') }}" class="list-group-item"><i class="fa fa-book"></i> Manage Address Book</a>
						<a href="{{ route('account-change-password') }}" class="list-group-item"><i class="fa fa-asterisk"></i> Change Password</a>
						<a href="{{ route('account-settings') }}" class="list-group-item"><i class="fa fa-cog"></i> Edit Profile Settings</a>
					</div>

				</div>
				<div class="col-lg-4">

					<h3>Billing</h3>
					<div class="list-group">
						<a href="{{ route('account-billing-payments') }}" class="list-group-item"><i class="fa fa-money"></i> Payments <span class="badge badge-primary">{{ \Sentinel::getUser()->seatpayments->count() }}</span></a>

						<a href="{{ route('account-billing-charges') }}" class="list-group-item"><i class="fa fa-credit-card"></i> Charges</a>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>
@stop