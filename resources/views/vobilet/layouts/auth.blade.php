<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
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
		@yield('css')
		<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="{{ Theme::url('plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

		<!---Font icons-->
		<link href="{{ Theme::url('plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
	</head>
	<body class="login-img" style="background-image: url('{{ Theme::url('images/lan.jpg') }}');">
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

		@yield('javascript')
		
		<!-- Custom js -->
		<script src="{{ Theme::url('js/custom.js') }}"></script>

		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
		<script>
			window.addEventListener("load", function(){
			window.cookieconsent.initialise({
			  "palette": {
			    "popup": {
			      "background": "#333333",
			      "text": "#ffffff"
			    },
			    "button": {
			      "background": "#0061da",
			      "text": "#ffffff"
			    }
			  },
			  "content": {
			    "message": "{{ __('global.cookieconsent.message') }}",
			    "dismiss": "{{ __('global.cookieconsent.dismiss') }}",
			    "link": "{{ __('global.cookieconsent.link') }}",
			    "href": "{{ url('/privacy') }}"
			  }
			})});
		</script>

		@if(Setting::get('GOOGLE_ANALYTICS_TRACKING_ID'))
			<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
				ga('create', '{{ Setting::get('GOOGLE_ANALYTICS_TRACKING_ID') }}', 'auto');
				ga('send', 'pageview');
			</script>
		@endif
		
	</body>
</html>
 