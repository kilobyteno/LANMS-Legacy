<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		
		<link rel="apple-touch-icon" sizes="180x180" href="{{ Theme::url('favicon/apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ Theme::url('favicon/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ Theme::url('favicon/favicon-16x16.png') }}">
		<link rel="manifest" href="{{ Theme::url('favicon/site.webmanifest') }}">
		<link rel="mask-icon" href="{{ Theme::url('favicon/safari-pinned-tab.svg') }}" color="#000000">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="theme-color" content="#ffffff">

		<!-- Title -->
		<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

		<!-- Dashboard Css -->
		@if(Sentinel::check())
			@if(Sentinel::getUser()->theme)
				<link href="{{ Theme::url('css/dashboard-'.Sentinel::getUser()->theme.'.css') }}" rel="stylesheet" />
				<link href="{{ Theme::url('plugins/wysiwyag/richtext.'.Sentinel::getUser()->theme.'.css') }}" rel="stylesheet">
				<link href="{{ Theme::url('plugins/select2/select2.'.Sentinel::getUser()->theme.'.css') }}" rel="stylesheet">
			@else
				<link href="{{ Theme::url('css/dashboard-default.css') }}" rel="stylesheet" />
				<link href="{{ Theme::url('plugins/wysiwyag/richtext.default.css') }}" rel="stylesheet">
				<link href="{{ Theme::url('plugins/select2/select2.default.css') }}" rel="stylesheet">
			@endif
		@else
			<link href="{{ Theme::url('css/dashboard-default.css') }}" rel="stylesheet" />
			<link href="{{ Theme::url('plugins/wysiwyag/richtext.default.css') }}" rel="stylesheet">
			<link href="{{ Theme::url('plugins/select2/select2.default.css') }}" rel="stylesheet">
		@endif
		<!-- Sidemenu Css -->
		<link href="{{ Theme::url('plugins/toggle-sidebar/css/sidemenu.css') }}" rel="stylesheet">
		<!-- c3.js Charts Plugin -->
		<link href="{{ Theme::url('plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />
		<!---Font icons-->
		<link href="{{ Theme::url('plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
		<!---Custom-->
		@yield('css')
		<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet" />
		@if(Setting::get('APP_LICENSE_STATUS') == "Invalid" || Setting::get('APP_LICENSE_STATUS') == "Expired" || Setting::get('APP_LICENSE_STATUS') == "Suspended")
			<style type="text/css">
				.app-header, .card, .footer, .app-sidebar, .slide.is-expanded [data-toggle="slide"], .slide-menu, .slide.is-expanded .slide-menu li a:hover  {
					background:#f5c6cb;
				}
				.side-menu__item, .slide.is-expanded a{
					color:#6b1110;
				}
				body {
					background:#f5d2d2;
				}
			</style>
		@endif
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
								<img src="{{ Setting::get('WEB_LOGO_LIGHT') }}" class="header-brand-img" alt="{{ Setting::get('WEB_NAME') }}">
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
												<span class="text-light" id="usermenu">{{ Sentinel::getUser()->firstname }}@if(Sentinel::getUser()->showname && Sentinel::getUser()->lastname) {{ Sentinel::getUser()->lastname }}@endif <i class="fas fa-caret-up"></i></span>
											</span>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
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
						<li class="slide @if(Request::is('admin/users*')){{'is-expanded'}} @endif">
							<a class="side-menu__item @if(Request::is('admin/billing*')){{'active'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-users-cog"></i><span class="side-menu__label">Members</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li>
									<a class="side-menu__item @if(Request::is('admin/users*') && !Request::is('admin/users/roles*')){{'active'}} @endif" href="{{ route('admin-users') }}"><i class="side-menu__icon fas fa-users"></i><span class="side-menu__label">Users</span></a>
								</li>
								<li>
									<a class="side-menu__item @if(Request::is('admin/users/roles*')){{'active'}} @endif" href="{{ route('admin-roles') }}"><i class="side-menu__icon fas fa-user-shield"></i><span class="side-menu__label">Roles</span></a>
								</li>
							</ul>
						</li>
						
						<li class="slide @if(Request::is('admin/billing*')){{'is-expanded'}} @endif">
							<a class="side-menu__item @if(Request::is('admin/billing*')){{'active'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-money-bill-alt"></i><span class="side-menu__label">Billing</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item @if(Request::is('admin/billing/invoice*')){{'active'}} @endif" href="{{ route('admin-billing-invoice') }}"><i class="fas fa-file-invoice mr-1"></i> Invoice</a></li>
							</ul>
						</li>
						<li class="slide @if(Request::is('admin/crew*')){{'is-expanded'}} @endif">
							<a class="side-menu__item @if(Request::is('admin/crew*')){{'active'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-crown"></i><span class="side-menu__label">Crew</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item @if(Request::is('admin/crew*') && !Request::is('admin/crew/categories*') && !Request::is('admin/crew/skill*')){{'active'}} @endif" href="{{ route('admin-crew') }}"><i class="fa fa-user mr-1"></i> Members</a></li>
								<li><a class="slide-item @if(Request::is('admin/crew/categories*')){{'active'}} @endif" href="{{ route('admin-crew-category') }}"><i class="fa fa-tag mr-1"></i> Categories</a></li>
								<li><a class="slide-item @if(Request::is('admin/crew/skill*') && !Request::is('admin/crew/skill/attachment*')){{'active'}} @endif" href="{{ route('admin-crew-skill') }}"><i class="fa fa-briefcase mr-1"></i> Skills</a></li>
							</ul>
						</li>
						<li class="slide @if(Request::is('admin/news*')){{'is-expanded'}} @endif">
							<a class="side-menu__item @if(Request::is('admin/news*')){{'active'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-newspaper"></i><span class="side-menu__label">News</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item @if(Request::is('admin/news*') && !Request::is('admin/news/categories*')){{'active'}} @endif" href="{{ route('admin-news') }}"><i class="far fa-newspaper mr-1"></i> Articles</a></li>
								<li><a class="slide-item @if(Request::is('admin/news/categories*')){{'active'}} @endif" href="{{ route('admin-news-category') }}"><i class="fas fa-tags mr-1"></i> Categories</a></li>
							</ul>
						</li>
						<li class="slide @if(Request::is('admin/seating*')){{'is-expanded'}} @endif">
							<a class="side-menu__item @if(Request::is('admin/seating*')){{'active'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-chair"></i><span class="side-menu__label">Seating</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item @if(Request::is('admin/seating/row*')){{'active'}} @endif" href="{{ route('admin-seating-rows') }}"><i class="fas fa-align-justify mr-1"></i> Rows</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/seat*')){{'active'}} @endif" href="{{ route('admin-seating-seats') }}"><i class="fas fa-chair mr-1"></i> Seats</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/tickettype*')){{'active'}} @endif" href="{{ route('admin-seating-tickettypes') }}"><i class="fas fa-ticket-alt mr-1"></i> Ticket Type</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/reservation*') && !Request::is('admin/seating/reservation/brokenband*')){{'active'}} @endif" href="{{ route('admin-seating-reservations') }}"><i class="fas fa-hand-paper mr-1"></i> Reservations</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/reservation/brokenband*')){{'active'}} @endif" href="{{ route('admin-seating-brokenband') }}"><i class="fas fa-unlink mr-1"></i> Broken Band</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/checkin*') && !Request::is('admin/seating/checkin/visitor*')){{'active'}} @endif" href="{{ route('admin-seating-checkin') }}"><i class="fas fa-user-check mr-1"></i> Atendee Check-in</a></li>
								<li><a class="slide-item @if(!Request::is('admin/seating/checkin*') && Request::is('admin/seating/checkin/visitor*')){{'active'}} @endif" href="{{ route('admin-seating-checkin-visitor') }}"><i class="fas fa-user-astronaut mr-1"></i> Visitor Check-in</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/print*')){{'active'}} @endif" href="{{ route('admin-seating-print') }}"><i class="fas fa-print mr-1"></i> Print Seat</a></li>
								<li><a class="slide-item @if(Request::is('admin/seating/styling*')){{'active'}} @endif" href="{{ route('admin-seating-styling') }}"><i class="far fa-file-code mr-1"></i> Styling</a></li>
							</ul>
						</li>
						<li>
							<a class="side-menu__item @if(Request::is('admin/compo')){{'active'}} @endif" href="{{ route('admin-compo') }}"><i class="side-menu__icon fas fa-compress-arrows-alt"></i><span class="side-menu__label">Compo</span></a>
						</li>
						<li>
							<a class="side-menu__item @if(Request::is('admin/pages')){{'active'}} @endif" href="{{ route('admin-pages') }}"><i class="side-menu__icon fas fa-file-alt"></i><span class="side-menu__label">Pages</span></a>
						</li>
						<li>
							<a class="side-menu__item @if(Request::is('admin/info')){{'active'}} @endif" href="{{ route('admin-info') }}"><i class="side-menu__icon fas fa-info-circle"></i><span class="side-menu__label">Info</span></a>
						</li>
						<li>
							<a class="side-menu__item @if(Request::is('admin/sponsor')){{'active'}} @endif" href="{{ route('admin-sponsor') }}"><i class="side-menu__icon fas fa-money-check-alt"></i><span class="side-menu__label">Sponsor</span></a>
						</li>
						@if(Sentinel::getUser()->hasAccess(['admin.emails.*']))
							<li>
								<a class="side-menu__item @if(Request::is('admin/email*')){{'active'}} @endif" href="{{ route('admin-emails') }}"><i class="side-menu__icon fas fa-envelope"></i><span class="side-menu__label">Emails</span></a>
							</li>
						@endif
						<li class="slide @if(Request::is('admin/system*')){{'is-expanded'}} @endif">
							<a class="side-menu__item @if(Request::is('admin/system*')){{'active'}} @endif" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-cogs"></i><span class="side-menu__label">System</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item @if(Request::is('admin/system/whatsnew*')){{'active'}} @endif" href="{{ route('admin-whatsnew') }}"><i class="far fa-lightbulb mr-1"></i> What's New?</a></li>
								<li><a class="slide-item @if(Request::is('admin/system/activity*')){{'active'}} @endif" href="{{ route('admin-activity') }}"><i class="fas fa-chart-line mr-1"></i> Activity Log</a></li>
								@if(Sentinel::inRole('superadmin'))
									<li><a class="slide-item @if(Request::is('admin/system/settings*')){{'active'}} @endif" href="{{ route('admin-settings') }}"><i class="fas fa-cog mr-1"></i> Settings</a></li>
									<li><a class="slide-item @if(Request::is('admin/system/logs*')){{'active'}} @endif" href="{{ route('admin-logs') }}"><i class="fas fa-clipboard-list mr-1"></i> System Logs</a></li>
									<li><a class="slide-item @if(Request::is('admin/system/license*')){{'active'}} @endif" href="{{ route('admin-license') }}"><i class="far fa-id-card mr-1"></i> License</a></li>
								@endif
								<li><a class="slide-item @if(Request::is('admin/system/info*')){{'active'}} @endif" href="{{ route('admin-systeminfo') }}"><i class="fas fa-microchip mr-1"></i> System Info</a></li>
							</ul>
						</li>
					</ul>
				</div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 376px; max-height: 625px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></aside>
				<div class="app-content my-3 my-md-5">
					<div class="side-app">
						<div style="min-height:80vh">
							
							@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")
								<div class="alert alert-danger mt-5" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(trans('global.alert.important')) }}!</strong> Unlicensed version of this software! Please check your license key on the <a href="{{ route('admin-license') }}">License page</a>.</div>
							@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")
								<div class="alert alert-danger mt-5" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(trans('global.alert.important')) }}!</strong> Your license has expired! Please contact your provider.</div>
							@endif

							@component('layouts.alert-session') @endcomponent

							@if($errors->any())
								@component('layouts.alert-form')
								    @foreach ($errors->all() as $message)
										<p>{{ $message }}</p>
									@endforeach
								@endcomponent
							@endif

							@yield('content')

						</div>
					</div>
					<footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
									&copy; {{ Setting::get('WEB_COPYRIGHT') }} &middot; <i class="fa fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
									<br>
									<div class="text-center mt-3 mb-3">
										<div class="dropup btn-group">
											<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fas fa-language"></i> {{ mb_strtoupper(App::getLocale()) }}<span class="caret"></span></button>
											<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
												@foreach(array_flip(config('app.locales')) as $lang)
													<li><a href="{{ route('locale', $lang) }}">{{ trans('language.'.$lang) }}</a></li>
												@endforeach
											</ul>
										</div>
										@if(Sentinel::check())
											<a class="btn btn-secondary btn-sm" href="{{ route('theme') }}"><i class="fas fa-adjust"></i></a>
										@endif
									</div>
									<p class="mt-2"><a href="http://lanms.xyz/" target="_blank">{{ Setting::get('APP_NAME') }}</a> <a href="{{ Setting::get('APP_URL') }}">{{ Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> {{ trans('global.by') }} <a href="https://infihex.com/" target="_blank">Infihex</a></p>
									@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")
										<div class="alert alert-danger text-uppercase" role="alert">
											<strong><i class="far fa-frown mr-2"></i>Unlicensed version of this software!</strong>
										</div>
									@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")
										<div class="alert alert-danger text-uppercase" role="alert">
											<strong><i class="far fa-frown mr-2"></i>License has expired for this software!</strong>
										</div>
									@elseif(Setting::get('APP_LICENSE_STATUS') == "Suspended")
										<div class="alert alert-danger text-uppercase" role="alert">
											<strong><i class="far fa-frown mr-2"></i>License has been suspended for this software!</strong>
										</div>
									@endif
									@if(Config::get('app.debug'))
										<b><span class="text-danger">{{ mb_strtoupper(trans('footer.debugmode')) }}</span></b>
									@endif
									@if(Config::get('app.debug') && Setting::get('APP_SHOW_RESETDB'))
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
		<script src="{{ Theme::url('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
		<script src="{{ Theme::url('plugins/charts-c3/d3.v5.min.js') }}"></script>
		<script src="{{ Theme::url('plugins/charts-c3/c3-chart.js') }}"></script>
		<script src="{{ Theme::url('plugins/select2/select2.full.min.js') }}"></script>

		@yield('javascript')
		
		<!-- Custom js -->
		<script src="{{ Theme::url('js/custom.js') }}"></script>

		<script type="text/javascript">
			$('#usermenu').click(function() {
				$("i", this).toggleClass("fa-caret-up fa-caret-down");
			});
			$(document).ready(function() {
				$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
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