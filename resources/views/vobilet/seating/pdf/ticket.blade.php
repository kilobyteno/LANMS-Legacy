<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:14px;line-height:1.25;color:#333}
			.row {width:100%;overflow:auto;margin-top: 17px;margin-bottom: 17px;display:inline-block}
			.col-md-12 {width:100%;float:left;display:inline-block}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			.clms {margin-top: 17px;margin-bottom: 17px;border-top: 1px solid #eee;border-bottom: 1px solid #eee; display: block; height: 80px;}
			.clms:after {content:".";display:block;height:0;visibility:hidden;clear: both;}
			.aclm {width:33%;display: inline-block; padding-top: 15px}
			small {font-size:95%;color:#999}
			h1 {font-size:3em;margin:0;padding:0}
			h2 {font-size:2em;margin:0;padding:0}
			p {margin:0;padding:0}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>	
		<div class="col-md-12">
			<div class="text-center">
				<br>
				<img src=".{{ Setting::get('WEB_LOGO_DARK') }}" style="max-width:50%;display: inline-block;">
				<br>
				<h1>{{ __('pdf.ticket.title') }}</h1>
				<br>
			</div>
			<hr>
			<h2 class="text-center">{{ $reservedfor->firstname.' '.$reservedfor->lastname }}<br><small>{{ $reservedfor->username }}</small></h2>
			<br>
			<p>{{ __('pdf.ticket.desc') }}</p>
			<br>
			<p>{{ __('pdf.ticket.moreinfo') }}: <strong>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/</strong></p>
			<div class="text-center clms">
				<div class="aclm">
					<h2><strong><small>{{ __('global.type') }}:</small><br>{{ $seat->tickettype->name }}</strong></h2>
				</div>
				<div class="aclm">
					@if(is_null($payment))
						<h2><strong><small>{{ __('global.payment.paid') }}:</small><br><span class="text-danger">{{ __('global.no') }} ({{ moneyFormat($seat->tickettype->price, Setting::get('MAIN_CURRENCY')) }})</span></strong></h2>
					@else
						<h2><strong><small>{{ __('global.payment.paid') }}:</small><br><span class="text-success">{{ __('global.yes') }}</span></strong></h2>
					@endif
				</div>
				<div class="aclm">
					<h2><strong><small>{{ __('pdf.ticket.yourseat') }}:</small><br>{{ $seat->name }}</strong></h2>
				</div>
			</div>
			@if($payment && $reservedfor->age() >= 15)
				<p class="text-center" style="border-bottom: 1px solid #eee;margin-bottom: 17px;padding-bottom: 20px">{{ __('seating.ticket.checkin.title') }}: <strong>{{ $ticket->code ?? __('global.unknown') }}</strong></p>
			@endif
			<div style="padding-top: 20px">
				<img style="display: inline-block;" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($ticket->barcode, "I25", 4, 40) }}" />
				<br>
				<h1><small>{{ $ticket->barcode }}</small></h1>
			</div>
		</div>
	</body>
</html>