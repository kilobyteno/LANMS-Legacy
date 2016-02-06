<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>

	<link href="{{ Theme::url('css/materialize.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/style.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/toastr.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<script src="{{ Theme::url('js/jquery-1.11.0.min.js') }}"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="{{ Theme::url('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

<div class="wrap">

<div class="highlighted parallax-container">
	<a class="logo" href="{{ url('/') }}">
		<img src="{{ asset('images/downlink.png') }}" alt="logo" width="600">
	</a>
	<div class="parallax"><img src="{{ asset('images/lan.jpg') }}" alt="mountain fog" /></div>
</div>

<header class="white z-depth-1">
	<div class="container">

		<div class="row">

			<div class="col s12">
				<nav>
					<div class="nav-wrapper">
						<a class="button-collapse" href="#" data-activates="nav-mobile">
							<i class="mdi-navigation-menu"></i>
						</a>

						<ul class="desktop-menu hide-on-med-and-down">
							<li class="@if(Request::is('/')){{'active'}} @endif"><a href="{{ url('/') }}"><span>Home</span></a></li>
							@foreach($pagesinmenu as $page)
								<li class="@if(Request::is($page->slug)){{'active'}} @endif"><a href="{{ route('page', $page->slug) }}"><span>{{ $page->title }}</span></a></li>
							@endforeach
							@if(Sentinel::Guest())
								<li><a href="{{ route('account-login') }}"><span>Login</span></a></li>
							@else
								<li><a href="{{ route('account') }}"><span><em>Go to Dashboard</em></span></a></li>
							@endif
						</ul>

						<ul class="side-nav" id="nav-mobile">
							<li><a href="{{ url('/') }}"><span>Home</span></a></li>
							@foreach($pagesinmenu as $page)
								<li class="@if(Request::is($page->slug)){{'active'}} @endif"><a href="{{ route('page', $page->slug) }}"><span>{{ $page->title }}</span></a></li>
							@endforeach
							@if(Sentinel::Guest())
								<li><a href="{{ route('account-login') }}"><span>Login</span></a></li>
							@else
								<li><a href="{{ route('account') }}"><span><em>Go to Dashboard</em></span></a></li>
							@endif
						</ul>

					</div>
				</nav>
			</div>
		</div>

	</div>
</header>

<div class="main-content">
	@yield('content')
</div>

<footer class="white z-depth-1 center">
	<div class="container">

		<div class="row">
			<div class="col s12">
				<p>
						<a href="{{ Setting::get('APP_URL') }}" target="_blank">{{ Setting::get('APP_NAME') . ' ' . Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> by <a href="https://infihex.com/" target="_blank">Infihex</a>
						<br>
						@if(Config::get('app.debug'))
							<b><span class="text-danger">DEBUG MODE</span></b>
						@endif
						@if(Setting::get('APP_SHOW_RESETDB'))
							<b>&middot; <a href="/resetdb" class="text-danger">RESET DB AND SETTINGS</a></b>
						@endif
					<br>
					<small class="text-muted">Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
				</p>
				</div>
			</div>

		<a class="back-to-top btn-floating btn-large waves-effect waves-light blue-grey darken-1" href="#header"><i class="mdi-navigation-expand-less"></i></a>

	</div>
</footer>

</div>


	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/jquery-2.1.1.min.js') }}"></script>
	<script src="{{ Theme::url('js/materialize.min.js') }}"></script>
	<script src="{{ Theme::url('js/retina.min.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.smooth-scroll.min.js') }}"></script>
	<script src="{{ Theme::url('js/app.js') }}"></script>
	<script src="{{ Theme::url('js/custom.js') }}"></script>
	<script src="{{ Theme::url('js/toastr.js') }}"></script>

	<script type="text/javascript">

		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-bottom-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		@if(Session::has('message') && Session::has('messagetype'))
			@if(Session::get('messagetype') == 'info')
				toastr.info("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'warning')
				toastr.warning("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'error')
				toastr.error("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'success')
				toastr.success("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@endif

		@endif

	</script>

	@yield('javascript')

</body>
</html>
