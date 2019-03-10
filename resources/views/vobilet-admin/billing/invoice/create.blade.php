@extends('layouts.main')
@section('title', 'Create Invoice - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Invoice</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item">{{ trans('user.account.billing.invoice.title') }}</li>
		<li class="breadcrumb-item active" aria-current="page">Create Invoice</li>
	</ol>
</div>


<div class="row">
	<div class="col-md-12">
		<form class="card" method="post" action="{{ route('admin-billing-invoice-store') }}">
			<div class="card-body">
				<div class="form-group">
					<label class="form-label">User:</label>
					<select name="user_id" class="select2">
						@foreach(\User::orderBy('lastname', 'asc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->get() as $user)
							<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
						@endforeach
					</select>
					@if($errors->has('user_id'))
						<p class="text-danger">{{ $errors->first('user_id') }}</p>
					@endif
				</div>
			</div>
			<div class="card-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Create</button>
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
@stop