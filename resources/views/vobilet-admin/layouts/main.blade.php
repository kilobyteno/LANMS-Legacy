<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="{{ Theme::url('favicon.ico') }}" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="{{ Theme::url('favicon.ico') }}" />

		<!-- Title -->
		<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

		<!-- Dashboard Css -->
		<link href="{{ Theme::url('css/dashboard-default.css') }}" rel="stylesheet" />
		<!-- Sidemenu Css -->
		<link href="{{ Theme::url('plugins/toggle-sidebar/css/sidemenu.css') }}" rel="stylesheet">
		@yield('css')
		<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="{{ Theme::url('plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

		<!---Font icons-->
		<link href="{{ Theme::url('plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
	</head>
	<body class="app sidebar-mini rtl">
		<div id="global-loader"></div>
		<div class="page">
			<div class="page-main">
				<!-- Navbar-->
				<header class="app-header header">

					<!-- Sidebar toggle button-->
					<!-- Navbar Right Menu-->
					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="{{ route('home') }}">
								<img src="{{ Setting::get('WEB_LOGO') }}" class="header-brand-img" alt="{{ Setting::get('WEB_NAME') }}">
							</a>
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"><i class="fas fa-bars"></i></a>
							<div class="d-flex order-lg-2 ml-auto">
								@if(Sentinel::Guest())
									<div class="d-none d-md-flex">
										<a href="{{ route('account-signin') }}" class="nav-link btn btn-sm btn-outline-primary mr-2"><i class="fas fa-sign-in-alt mr-2"></i>{{ trans('auth.signin.button') }}</a>
										<a href="{{ route('account-signup') }}" class="nav-link btn btn-sm btn-outline-secondary"><i class="fas fa-pencil-alt mr-2"></i>{{ trans('auth.signup.button') }}</a>
									</div>
								@else
									<div class="dropdown">
										<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
											<span class="avatar avatar-md brround" style="background-image: url({{ Sentinel::getUser()->profilepicturesmall ?? '/images/profilepicture/0_small.png' }})"></span>
											<span class="ml-2 d-none d-lg-block">
												<span class="text-white" id="usermenu">{{ Sentinel::getUser()->firstname }}@if(Sentinel::getUser()->showname && Sentinel::getUser()->lastname) {{ Sentinel::getUser()->lastname }}@endif <i class="fas fa-caret-up"></i></span>
											</span>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
											@if(Sentinel::hasAccess('admin'))
												<a class="dropdown-item" href="{{ route('admin') }}">
													<i class="fa fa-user-secret"></i> {{ trans('user.adminpanel') }}
												</a>
												<div class="dropdown-divider"></div>
											@endif
											<a class="dropdown-item" href="{{ route('dashboard') }}">
												<i class="fas fa-tachometer-alt"></i> {{ trans('user.dashboard.title') }}
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('account') }}">
												<i class="fas fa-id-card"></i> {{ trans('user.account.title') }}
											</a>
											<a class="dropdown-item" href="{{ route('user-profile', Sentinel::getUser()->username) }}">
												<i class="fas fa-user-circle"></i> {{ trans('user.profile.title') }}
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('logout') }}">
												<i class="fas fa-sign-out-alt"></i> {{ trans('auth.signout') }}
											</a>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</header>

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;"><div id="mCSB_1" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
					<ul class="side-menu">
						<li>
							<a class="side-menu__item @if(Request::is('admin')){{'active'}} @endif" href="{{ route('admin') }}"><i class="side-menu__icon fa fa-tachometer-alt"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li>
							<a class="side-menu__item @if(Request::is('admin/users')){{'active'}} @endif" href="{{ route('admin-users') }}"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Users</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item @if(Request::is('admin/crew*')){{'active opened'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-home"></i><span class="side-menu__label">Crew</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item @if(Request::is('admin/crew/categories*')){{'active'}} @endif" href="{{ route('admin-crew-category') }}"><i class="fa fa-tag mr-1"></i> Categories</a></li>
								<li><a class="slide-item @if(Request::is('admin/crew*') && !Request::is('admin/crew/categories*') && !Request::is('admin/crew/skill*')){{'active'}} @endif" href="{{ route('admin-crew') }}"><i class="fa fa-user-md mr-1"></i> Members</a></li>
								<li><a class="slide-item @if(Request::is('admin/crew/skill*') && !Request::is('admin/crew/skill/attachment*')){{'active'}} @endif" href="{{ route('admin-crew-skill') }}"><i class="fa fa-briefcase mr-1"></i> Skills</a></li>
								<li><a class="slide-item @if(Request::is('admin/crew/skill/attachment*')){{'active'}} @endif" href="{{ route('admin-crew-skill-attachment') }}"><i class="fa fa-paperclip mr-1"></i> Skill Attachment</a></li>
							</ul>
						</li>
					</ul>
				</div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 376px; max-height: 625px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></aside>
				<div class="app-content my-3 my-md-5">
					<div class="side-app">
						
						@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")
							<div class="alert alert-danger" role="alert"><i class="fa fa-frown-o mr-2" aria-hidden="true"></i> <strong>{{ mb_strtoupper(trans('global.alert.important')) }}!</strong> Unlicensed version of this software! Please check your license key on the <a href="{{ route('admin-license') }}">License Status page</a>.</div>
						@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")
							<div class="alert alert-danger" role="alert"><i class="fa fa-frown-o mr-2" aria-hidden="true"></i> <strong>{{ mb_strtoupper(trans('global.alert.important')) }}!</strong> Your license has expired! Please contact your provider.</div>
						@endif

						@component('layouts.alert-session') @endcomponent

						@yield('content')

					</div>
					<footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
									&copy; {{ Setting::get('WEB_COPYRIGHT') }} &middot; <i class="fa fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
									<br>
									<p class="mt-2"><a href="http://lanms.xyz/" target="_blank">{{ Setting::get('APP_NAME') }}</a> <a href="{{ Setting::get('APP_URL') }}">{{ Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> {{ trans('global.by') }} <a href="https://infihex.com/" target="_blank">Infihex</a></p>
									@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")<b class="text-danger">Unlicensed version of this software!</b>@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")<b class="text-danger">License has expired for this software!</b>@endif
									@if(Config::get('app.debug'))
										<b><span class="text-danger">{{ mb_strtoupper(trans('footer.debugmode')) }}</span></b>
									@endif
									@if(Config::get('app.debug') && Setting::get('SHOW_RESETDB'))
										<b>&middot; <a href="/resetdb" class="text-danger">{{ mb_strtoupper(trans('footer.resetdbandsettings')) }}</a></b>
									@endif 
								</div>
							</div>
						</div>
					</footer>
				</div>
			</div>

		</div>
		<!-- Back to top -->
		<a href="#top" id="back-to-top" style="display: none;"><i class="fa fa-angle-up"></i></a>
		<!-- Dashboard js -->
		<script src="{{ Theme::url('js/vendors/jquery-3.2.1.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/jquery.sparkline.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/selectize.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/jquery.tablesorter.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/circle-progress.min.js') }}"></script>
		<script src="{{ Theme::url('js/vendors/circle-progress.min.js') }}"></script>
		<script src="{{ Theme::url('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
		<script src="{{ Theme::url('plugins/charts-c3/d3.v5.min.js') }}"></script>
		<script src="{{ Theme::url('plugins/charts-c3/c3-chart.js') }}"></script>

		@yield('javascript')
		
		<!-- Custom js -->
		<script src="{{ Theme::url('js/custom.js') }}"></script>

		<script type="text/javascript">
			$('#usermenu').click(function() {
				$("i", this).toggleClass("fa-caret-up fa-caret-down");
			});
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