<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

		<!-- Title -->
		<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		
		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

		<!-- Dashboard Css -->
		<link href="{{ Theme::url('css/dashboard-default.css') }}" rel="stylesheet" />
		<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="{{ Theme::url('plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

		<!---Font icons-->
		<link href="{{ Theme::url('plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
	</head>
	<body class="login-img">
		<div id="global-loader"></div>
		<div class="page">
			<div class="page-single">
				@yield('content')
			</div>
		</div>
		
		<!-- Dashboard js -->
		<script src="{{ Theme::url('js/vendors/jquery-3.2.1.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/jquery.sparkline.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/selectize.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/jquery.tablesorter.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/circle-progress.min.js') }}"></script>
		
		<!-- Custom js -->
		<script src="{{ Theme::url('js/custom.js') }}"></script>
	</body>
</html>
 