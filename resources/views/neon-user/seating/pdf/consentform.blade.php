<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:14px;line-height:1.25;color:#333}
			.row {overflow:auto}
			.col-md-6 {width:50%;float:left;display:inline-block}
			.col-md-12 {width:100%;float:left;display:inline-block}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			small {font-size:95%;color:#999}
			h1 {font-size:3em;margin:0;padding:0}
			h2 {font-size:2em;margin:0;padding:0}
			p {margin:0;padding:0;margin-bottom:20px}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>
		<div class="row">
			<div class="col-md-12 text-center">
				<img src=".{{ Setting::get('WEB_LOGO') }}" style="width:auto;max-width:700px;">
				<h1>Samtykkeskjema<br><small>{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</small></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>Alle deltakere under 16 år må ha med seg skriftlig tillatelse fra foresatte til å være med på arrangementet. Mindreårige deltakere som ikke har tillatelse er vi dessverre nødt til å avvise. Downlink har ingen aldersgrense, men vi anbefaler at deltakere under 16 år ikke kommer alene.</p>
				<p>Vi kan ikke gi noen personlig garanti under arrangementet, men vi gjør vårt ytterste for å sørge for at deltakerne får en minnerik vinterferie. </p>
				<br>
				<p>
					<strong>Informasjon til foreldre</strong>
					<br>
					Vi har samlet informasjon til foreldre på nettsidene våre;
					<br>
					<strong><em>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/tilforeldre</em></strong>
				</p>
				<hr>
				<br>
				<h2>Tillatelse til å delta på {{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</h2>
				<p>Jeg gir med dette tillatelse til at <strong>{{ strtoupper(Sentinel::getUser()->firstname . ' ' . Sentinel::getUser()->lastname) }}</strong> som er født <strong>{{ Sentinel::getUser()->birthdate }}</strong> kan delta på arrangementet &quot;{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}&quot; i {{ LANMS\Info::getContent('where') }} {{ LANMS\Info::getContent('when') }}.</p>
				<br>
				<p>Mitt forhold til deltakeren (sett strek under); <strong><em>mor</em></strong>, <strong><em>far</em></strong> eller <strong><em>annen omsorgsperson</em></strong> (spesifiser under).<br>______________________________________________________________________</p>
				<p>Kontaktinformasjon til omsorgsperson (om det skulle bli nødvendig):</p>
				<p>Fulltnavn:______________________________________________________________________ Telefonnummer:___________________________________</p>
				<p>Jeg kan treffes på telefon hele døgnet om det skulle oppstå en nødsituasjon og jeg er inneforstått med at arrangøren kan ringe for å kontrollere gyldigheten av denne tillatelsen.</p>
				<div class="row">
					<div class="col-md-6">
						<p>Sted og dato: _________________________________________________</p>
					</div>
					<div class="col-md-6">
						<p>Signatur: _________________________________________________</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>