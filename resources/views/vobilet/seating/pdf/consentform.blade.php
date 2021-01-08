<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:11px;color:#333}
			.row {display: block;}
			.row:after {clear: both;display: table;content: " ";box-sizing: border-box;}
			.col-md-12 {width:100%;float:left;position: relative;min-height: 1px;display: block;}
			.col-md-6 {width:50%;position: relative;min-height: 1px;display: block;}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			small {font-size:95%;color:#999}
			h1 {font-size:2.25em;margin:0;padding:0}
			h2 {font-size:1.25em;margin:0;padding:0}
			p {margin:0;padding:0;margin-bottom:5px;}
			hr {margin: 10px 0;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>
		<div class="row">
			<div class="col-md-12" style="text-align: center;">
				<img src=".{{ Setting::get('WEB_LOGO_DARK') }}" style="width:auto;height:auto;max-width:700px;max-height:75px;">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">{{ __('pdf.consentform.title') }}<br><small>{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</small></h1>
				<hr>
				<p>{{ __('pdf.consentform.desc') }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" style="float: left;">
				<p>{{ __('pdf.consentform.organizerswantright') }}:</p>
				<ul>
					{!! __('pdf.consentform.organizerswantrightpoints') !!}
				</ul>
			</div>
			<div class="col-md-6" style="float: right;">
				<p>{{ __('pdf.consentform.shouldalsobementioned') }}:</p>
				<ul>
					{!! __('pdf.consentform.shouldalsobementionedpoints') !!}
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>{!! __('pdf.consentform.moreinfo', ['url'=>Setting::get('WEB_PROTOCOL').'://'.Setting::get('WEB_DOMAIN')]) !!}</p>
				<hr>
				<h2>{!! __('pdf.consentform.permission', ['event'=>Setting::get('WEB_NAME').' '.Setting::get('SEATING_YEAR')]) !!}</h2>
				<p>{!! __('pdf.consentform.permissiondesc', ['event'=>Setting::get('WEB_NAME').' '.Setting::get('SEATING_YEAR'), 'name' => ($user ? LANMS\User::getFullnameByID($user->id) : '______________________________________________________'), 'birthdate' => ($user ? $user->birthdate : '__________________'), 'location'=>LANMS\Info::getContent('where').', '.LANMS\Info::getContent('when')]) !!}</p>
				<p>{!! __('pdf.consentform.myrelationship') !!}<br>______________________________________________________________________</p>
				<p>{!! __('pdf.consentform.contact') !!}:</p>
				<p>{{ __('global.fullname') }}: ____________________________________________________________________<br>{{ __('global.phone') }}: _________________________________<br>{{ __('global.email') }}: _________________________________</p>
				<p>{{ __('pdf.consentform.icanbecontacted') }}</p>
			</div>
		</div>
		<div class="row">
			<p>{!! __('pdf.consentform.filledoutbycaregiver') !!}:</p>
			<div class="col-md-6" style="float: left;">
				<p>{{ __('pdf.consentform.placeanddate') }}:<br><br>_________________________________________________</p>
			</div>
			<div class="col-md-6" style="float: right;">
				<p>{{ __('pdf.consentform.signature') }}:<br><br>_________________________________________________</p>
			</div>
		</div>
		<div class="row" style="margin-top:10px;padding-top:10px;border-top: 1px solid #eee">
			<p>{!! __('pdf.consentform.filledoutbyorganizers') !!}:</p>
			<div class="col-md-6" style="float: left;">
				<p>{{ __('pdf.consentform.signature') }}:<br><br>_________________________________________________</p>
			</div>
		</div>
	</body>
</html>