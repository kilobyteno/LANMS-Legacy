<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:14px;line-height:1.25;color:#333}
			.row {overflow:auto}
			.col-md-12 {width:100%;float:left;display:inline-block}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			small {font-size:95%;color:#999}
			h1 {font-size:2.5em;margin:0;padding:0}
			h2 {font-size:1.5em;margin:0;padding:0}
			p {margin:0;padding:0;margin-bottom:20px;font-size:13px;line-height:15px}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>
		<div class="row">
			<div class="col-md-12">
				<img src=".{{ Setting::get('WEB_LOGO') }}" style="width:auto;height:auto;max-width:700px;max-height:125px;">
				<h1 class="text-center">Samtykkeskjema<br><small>{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</small></h1>
				<hr>
				<p>Alle deltakere under 16 år må ha med seg skriftlig tillatelse fra omsorgsperson til å være med på arrangementet. Mindreårige deltakere som ikke har tillatelse er vi dessverre nødt til å avvise.</p>
				<p>Aldersgrensen for å delta på arrangementet er satt til 13 år, er deltaker under denne grensen må omsorgsperson være med på arrengementet.</p>
				<p>Arrangørene ønsker retten til:</p>
				<ul>
					<li>Å publisere bilde/video av deltaker på arrangementet sin nettside/sosialemedier. Åpen Facebook-side og åpen nettside. Når deltaker har kommet på pallplassering i konkurranser og/eller er med på oversiktlige bilder av arrangementet.</li>
					<li>Å kun ha gyldighet på dette samtykkeskjemaet i uken arrangementet skjer</li>
				</ul>
				<p>Det bør også nevnes at arrangørene;</p>
				<ul>
					<li>Vil ikke ta bilder av barna når de er svært lettkledde.</li>
					<li>Vil gjøre sitt beste for at bildene som publiseres på nett vil legges ut i en kvalitet som gjør det lite attraktivt for andre å manipulere dem eller benytte dem i andre sammenhenger.</li>
					<li>Vil alltid be om spesifikt samtykke fra omsorgsperson dersom det skal tas bilder av barna til journalistiske formål, eller dersom utplasserte studenter ønsker å ta bilder av barna.</li>
					<li>Vil ikke frigi digitale bildekopier av barnet uten spesifikt samtykke fra de foresatte.</li>
				</ul>
				<p>
					<strong>Informasjon til omsorgsperson</strong>
					<br>
					Vi har samlet informasjon til omsorgsperson på nettsidene våre:
					<br>
					<strong><em>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/tilforeldre</em></strong>
				</p>
				<hr>
				<h2>Tillatelse til å delta på {{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</h2>
				<p>Jeg gir med dette tillatelse til at <strong>{{ strtoupper(Sentinel::getUser()->firstname . ' ' . Sentinel::getUser()->lastname) }}</strong> som er født @if(Sentinel::getUser()->birthdate)<strong>{{ Sentinel::getUser()->birthdate }}</strong>@else{{ '__________________' }}@endif kan delta på arrangementet &quot;{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}&quot; i {{ LANMS\Info::getContent('where') }} {{ LANMS\Info::getContent('when') }}.</p>
				<p>Jeg gir med dette tillatelse til arrangørene som nevnt i punkt(ene) over.</p>
				<p>Mitt forhold til deltakeren (sett strek under); <strong><em>mor</em></strong>, <strong><em>far</em></strong> eller <strong><em>annen omsorgsperson</em></strong> (spesifiser under).<br>______________________________________________________________________</p>
				<p>Kontaktinformasjon til omsorgsperson, om det skulle bli nødvendig (<strong>skriv tydelig</strong>):</p>
				<p>Fulltnavn: ____________________________________________________________________<br>Telefonnummer: _________________________________<br>Epost: _________________________________</p>
				<p>Jeg kan treffes på telefon hele døgnet om det skulle oppstå en nødsituasjon og jeg er inneforstått med at arrangøren kan ringe for å kontrollere gyldigheten av denne tillatelsen.</p>
				<div class="row">
					<p>Fylles ut av <strong>omsorgsperson</strong>:</p>
					<div style="width:50%;float:left;display:inline-block">
						<p>Sted og dato:<br><br>_________________________________________________</p>
					</div>
					<div style="width:50%;float:right;display:inline-block">
						<p>Signatur:<br><br>_________________________________________________</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<p>Fylles ut av <em>arrangørene</em>:</p>
					<div style="width:50%;float:left;display:inline-block">
						<p>Dato:<br><br>_________________________________________________</p>
					</div>
					<div style="width:50%;float:right;display:inline-block">
						<p>Signatur:<br><br>_________________________________________________</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>