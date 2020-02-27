@extends('layouts.main')
@section('title', 'Create SMS - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create SMS</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-sms') }}">SMS</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">

		<form class="card" action="{{ route('admin-sms-store') }}" method="post">
			<div class="card-header">
				<div style="max-width: 250px">
					<select name="user_id" class="select2" required="required">
						<option value="">--- Please Select ---</option>
						@foreach(\User::orderBy('lastname', 'asc')->where('phone', '<>', '')->where('last_activity', '<>', '')->where('isAnonymized', '0')->get() as $user)
							<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
						@endforeach
					</select>
				</div>
				
				<div class="card-options">
					<button class="btn btn-success" type="submit"><i class="fas fa-paper-plane mr-2"></i> Send</button>
				</div>
			</div>
			<div class="card-body">
				<div class="input-group">
					<textarea class="form-control input-lg" id="message" name="message" placeholder="SMS Text" required="required">{{ (old('message')) ? old('message') : '' }}</textarea>
					@if($errors->has('message'))
						<p class="text-danger">{{ $errors->first('message') }}</p>
					@endif
				</div>
				<div class="row">
					<div class="col-xl-6">
						<p class="text-muted m-0">
							<span id="remaining">154 characters remaining</span>
							<span>&mdash;</span>
							<span id="messages">1 segment</span>
						</p>
					</div>
					<div class="col-xl-6 text-right">
						<p class="text-muted m-0">Estimated price: $<span id="price">0</span></p>
					</div>
				</div>
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
		</form>
		
	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		    var $remaining = $('#remaining'),
		        $messages = $remaining.next().next(),
		        $price = $('#price');
		    var smsMax = 160, price = 0.0620;
		    $('#message').on('input', function(){
		        var chars = this.value.length,
		            messages = Math.ceil(chars / smsMax),
		            remaining = messages * smsMax - (chars % (messages * smsMax) || messages * smsMax);
		        if (chars == 0) { remaining = smsMax; messages = 1; }
		        if (remaining == 1) {
		        	$remaining.text(remaining + ' character remaining');
		        } else {
		        	$remaining.text(remaining + ' characters remaining');
		        }
		        if (messages <= 1) {
		        	$messages.text(messages + ' segment');
		        } else {
		        	$messages.text(messages + ' segments');
		        }
		        $price.text((messages * price).toFixed(3));
		    });
		});
	</script>
@stop