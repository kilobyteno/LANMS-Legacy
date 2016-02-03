<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family: 'Open Sans', sans-serif;overflow:auto;margin: 0;font-size: 14px;line-height: 1.42857143;color: #333;}
			.row {overflow: auto}
			.col-md-6 {width:50%;float: left;display: inline-block;}
			.col-md-12 {width:100%;float: left;display: inline-block;}
			.text-center {text-align: center}
			.text-muted {color: #999;}
			small {font-size: 80%;color: #999;}
			h1 {font-size: 3em; margin: 0;padding:0;}
			h2 {font-size: 2em; margin: 0;padding:0;}
			p {margin: 0;padding:0;}
		</style>
	</head>
	<body>	
		<div class="col-md-12 text-center">
			<img src="img/logo.png" style="width:700px;">
			<h1>INNSJEKKINGSBEVIS</h1>
			<h2>username</h2>
			<p>Dette er ditt innsjekkingsbevis. Ta med dette til arrangementet (husk at det er et innsjekkingsbevis per plass). Det er også viktig at du tar med gyldig legitimasjon. Hvis du møter opp uten innsjekkingsbeviset eller legitimasjon, vil det ta lengre tid å sjekke deg inn på LANet. </p>
			<p>For oppmøtetidspunkt og mer informasjon, se nettsiden vår www.downlinkdg.no
			<p><strong>Din plass er: {{ $seat->name }}</strong></p>

			<br><br><br>
		</div>
		<p> <div style="display:inline-block"> {{ DNS1D::getBarcodeHTML(User::getUIDByID($seat->used_by), "I25") }} </div> <br> {{ User::getUIDByID($seat->used_by) }} </p>
	</body>
</html>