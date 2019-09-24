@extends('layouts.main')
@section('title', 'Create Email - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Email</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-emails') }}">Emails</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create</li>
	</ol>
</div>

<div class="row">
	<div class="col-6">

		<form class="card" action="{{ route('admin-emails-store') }}" method="post">
			<div class="card-header">
				<div class="card-title">
					Details
				</div>
				<div class="card-options">
					<button class="btn btn-success" type="submit"><i class="far fa-paper-plane"></i> Send</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="form-group">
							<label class="form-label">User:</label>
							<select name="user" class="select2" id="user">
								<option value="">-- None --</option>
								@foreach(\User::all() as $user)
									<option value="{{ $user->id }}" {{ (old('user') == $user->id) ? 'selected' : '' }}>{{ User::getFullnameAndNicknameByID($user->id) }}</option>
								@endforeach
							</select>
							@if($errors->has('user'))
								<p class="text-danger">{{ $errors->first('user') }}</p>
							@endif
						</div>
					</div>
					<div class="col-2 text-center">
						<em>~ or ~</em>
					</div>
					<div class="col-5">
						<div class="form-group">
							<label class="form-label">Bulk send (one email to each user):</label>
							<select name="bulk" class="select2" id="bulk">
								<option value="">-- None --</option>
								<option value="1" {{ (old('bulk')) ? 'selected' : '' }}>All active users</option>
								<option value="2" {{ (old('bulk')) ? 'selected' : '' }}>All users with a ticket for this event</option>
								<option value="3" {{ (old('bulk')) ? 'selected' : '' }}>All users with a ticket for -last- event</option>
							</select>
							@if($errors->has('bulk'))
								<p class="text-danger">{{ $errors->first('bulk') }}</p>
							@endif
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="form-label">Subject</label>
					<input type="text" class="form-control" id="subject_input" name="subject" autocomplete="off" placeholder="Subject" value="{{ (old('subject')) ? old('subject') : '' }}" />
					@if($errors->has('subject'))
						<p class="text-danger">{{ $errors->first('subject') }}</p>
					@endif
				</div>
				<div class="row">
					<div class="col-sm-12 @if($errors->has('content')) has-error @endif">
						<label class="form-label">Content (HTML is allowed):</label>
						<textarea name="content" class="form-control" id="message_input" rows="8">{{ (old('content')) ? old('content') : '' }}</textarea>
						@if($errors->has('content'))
							<p class="text-danger">{{ $errors->first('content') }}</p>
						@endif
					</div>
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
		</form>

	</div>

	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Preview</div>
			</div>
			<div class="card-body">
				<div style="border:1px solid #333;">
					<!doctype html>
					<html>
					<head>
					<meta name="viewport" content="width=device-width">
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<style>
					    *{font-family:"Helvetica Neue",Helvetica,Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0}.btn-primary td,h1,h2,h3,h4,p{font-family:"Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif}img{max-width:300px;width:100%}body{-webkit-font-smoothing:antialiased;height:100%;-webkit-text-size-adjust:none;width:100%!important}a{color:#348eda}.btn-primary{Margin-bottom:10px;width:auto!important}.btn-primary td{background-color:#348eda;border-radius:25px;font-size:14px;text-align:center;vertical-align:top}.btn-primary td a{background-color:#348eda;border:1px solid #348eda;border-radius:25px;border-width:10px 20px;display:inline-block;color:#fff;cursor:pointer;font-weight:700;line-height:2;text-decoration:none}.last{margin-bottom:0}.first{margin-top:0}.padding{padding:10px 0}table.body-wrap{padding:20px;width:100%}table.body-wrap .container{border:1px solid #f0f0f0;border-radius:6px}table.footer-wrap{clear:both!important;width:100%}.footer-wrap .container p{color:#666;font-size:12px}table.footer-wrap a{color:#999}h1,h2,h3{color:#111;font-weight:200;line-height:1.2em;margin:40px 0 10px}h1{font-size:36px}h2{font-size:28px}h3{font-size:22px}ol,p,ul{font-size:14px;font-weight:400;margin-bottom:10px}ol li,ul li{margin-left:5px;list-style-position:inside}.container{clear:both!important;display:block!important;Margin:0 auto!important;max-width:600px!important}.body-wrap .container{padding:20px}.content{display:block;margin:0 auto;max-width:600px}.content table{width:100%}hr{height:0;margin-top:17px;margin-bottom:17px;border:0;border-top:1px solid #eee}small{font-size:85%}h4{font-weight:500;line-height:1.1;color:#373e4a;font-size:15px}h4 small{font-weight:400;line-height:1;color:#999;font-size:75%}
					</style>
					</head>

					<body bgcolor="#f6f6f6">

					<!-- body -->
					<table class="body-wrap" bgcolor="#f6f6f6">
					    <tr>
					        <td></td>
					        <td class="container" bgcolor="#FFFFFF">

					            <!-- content -->
					            <div class="content">
					                <table>
					                    <tr>
					                        <td>
					                            <img src="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}{{ Setting::get('WEB_LOGO') }}" width="300"><br>
					                            <h2 id="email_subject">Subject</h2>
					                            <hr>
					                            <p id="email_message">Message</p>
					                            <p>&nbsp;</p>
					                            <p>&mdash; {{ Setting::get('WEB_NAME') }}</p>
					                        </td>
					                    </tr>
					                </table>
					            </div>
					            <!-- /content -->

					        </td>
					        <td></td>
					    </tr>
					</table>
					<!-- /body -->

					<!-- footer -->
					<table class="footer-wrap">
					    <tr>
					        <td></td>
					        <td class="container">

					            <!-- content -->
					            <div class="content">
					                <table>
					                    <tr>
					                        <td align="center">
					                            <h4><small><em>{{ trans('email.youreceived') }}</em></small><br><a href="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}/">{{ Setting::get('WEB_DOMAIN') }}</a></h4>
					                        </td>
					                    </tr>
					                </table>
					            </div>
					            <!-- /content -->

					        </td>
					        <td></td>
					    </tr>
					</table>
					<!-- /footer -->

					</body>
					</html>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
@section('javascript')
	<script type="text/javascript">
		$(document).ready(function(){
			@if(old('subject'))
				$("#email_subject").text($("#subject_input").val());
			@endif
			@if(old('message'))
				$("#email_message").html($("#message_input").val());
			@endif
		    $("#subject_input").on("input", function(){
		        $("#email_subject").text($(this).val());
		    });
		    $("#message_input").on("input", function(){
		        $("#email_message").html($(this).val());
		    });
		});
	</script>

	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
@stop