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
		<link rel="icon" href="./favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />

		<!-- Title -->
		<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

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
	<body class="">
		<div id="global-loader" ></div>
		<div class="page">
			<div class="page-main">
				<div class="header py-4">
					<div class="container">
						<div class="d-flex">
							<a class="header-brand" href="{{ route('home') }}">
								<img src="{{ Setting::get('WEB_LOGO_ALT') }}" class="header-brand-img" alt="{{ Setting::get('WEB_NAME') }}">
							</a>
							<div class="d-flex order-lg-2 ml-auto">
								@if(Sentinel::Guest())
									<div class="d-none d-md-flex">
										<a href="{{ route('account-signin') }}" class="nav-link btn btn-sm btn-outline-primary mr-2"><i class="fas fa-sign-in-alt mr-2"></i>{{ trans('auth.signin') }}</a>
										<a href="{{ route('account-signup') }}" class="nav-link btn btn-sm btn-outline-secondary"><i class="fas fa-pencil-alt mr-2"></i>{{ trans('auth.signup') }}</a>
									</div>
								@else
									<div class="dropdown">
										<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
											<span class="avatar avatar-md brround" style="background-image: url({{ Sentinel::getUser()->profilepicturesmall ?? '/images/profilepicture/0_small.png' }})"></span>
											<span class="ml-2 d-none d-lg-block">
												<span class="text-dark">{{ Sentinel::getUser()->firstname }}@if(Sentinel::getUser()->showname && Sentinel::getUser()->lastname) {{ Sentinel::getUser()->lastname }}@endif</span>
											</span>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
											@if(Sentinel::hasAccess('admin'))
												<a class="dropdown-item" href="{{ route('admin') }}">
													<i class="fa fa-user-secret"></i> Admin Panel
												</a>
												<div class="dropdown-divider"></div>
											@endif
											<a class="dropdown-item" href="{{ route('dashboard') }}">
												<i class="fas fa-tachometer-alt"></i> Dashboard
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('account') }}">
												<i class="fas fa-id-card"></i> Account
											</a>
											<a class="dropdown-item" href="{{ route('user-profile', Sentinel::getUser()->username) }}">
												<i class="fas fa-user-circle"></i> Profile
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('logout') }}">
												<i class="fas fa-sign-out-alt"></i> Sign out
											</a>
										</div>
									</div>
								@endif
							</div>
							<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
								<span class="header-toggler-icon"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-lg order-lg-first">
								<ul class="nav nav-tabs border-0 flex-column flex-lg-row">
									@if(Sentinel::Guest())
										<div class="d-block d-sm-none">
											<li class="nav-item">
												<a class="nav-link" href="{{ route('account-signin') }}"><i class="fas fa-sign-in-alt mr-2"></i>Sign in</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="{{ route('account-signup') }}"><i class="fas fa-pencil-alt mr-2"></i>Sign up</a>
											</li>
										</div>
									@endif
									<li class="nav-item">
										<a class="nav-link @if(Request::is('/')){{'active'}} @endif" href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('news*')){{'active'}} @endif" href="{{ route('news') }}"><i class="far fa-newspaper"></i> News</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('crew')){{'active'}} @endif" href="{{ route('crew') }}"><i class="fa fa-crown"></i> Crew</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('user/members*')){{'active'}} @endif" href="{{ route('members') }}"><i class="fas fa-users"></i> Members</a>
									</li> 
									<li class="nav-item">
										<a class="nav-link @if(Request::is('user/seating*')){{'active'}} @endif" href="{{ route('seating') }}"><i class="fas fa-chair"></i> Seating</a>
									</li> 
									@if(count(\LANMS\Page::forMenu()) > 0)
										<li class="nav-item">
											<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-info"></i> INFORMATION</a>
											<div class="dropdown-menu dropdown-menu-arrow">
												@foreach(\LANMS\Page::forMenu() as $page)
													<a class="dropdown-item @if(Request::is($page->slug)){{'active'}} @endif" href="{{ route('page', $page->slug) }}">{{ $page->title }}</a>
												@endforeach
											</div>
										</li>
									@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="my-3 my-md-5">
					<div class="container">
						@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")
							<div class="alert alert-danger" role="alert"><i class="fa fa-frown-o mr-2" aria-hidden="true"></i> <strong>IMPORTANT!</strong> Unlicensed version of this software! Please check your license key on the <a href="{{ route('admin-license') }}">License Status page</a>.</div>
						@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")
							<div class="alert alert-danger" role="alert"><i class="fa fa-frown-o mr-2" aria-hidden="true"></i> <strong>IMPORTANT!</strong> Your license has expired! Please contact your provider.</div>
						@endif

						@component('layouts.alert-session') @endcomponent

						@yield('content')

					</div>
				</div>
			</div>

			<!--footer-->
			<footer class="footer br-bl-7 br-br-7">
				<div class="container">
					@if(count(LANMS\Sponsor::thisYear()->get()) > 0)
						<div class="row">
							<div class="col-lg-12">
								<div id="sponsorcarousel" class="carousel slide mb-5 mt-2" data-ride="carousel" data-interval="3000">
							        <div class="carousel-inner row w-100 mx-auto" role="listbox">
							        	@foreach(LANMS\Sponsor::ordered()->thisYear()->get() as $sponsor)
								            <div class="carousel-item col-md-4 @if($sponsor->sort_order == 0) active @endif">
								                <a href="{{ $sponsor->url }}"><img class="img-fluid mx-auto d-block" src="{{ asset($sponsor->image) }}" alt="{{ $sponsor->name }}"></a>
								            </div>
							            @endforeach
							        </div>
							    </div>
							</div>
						</div>
					@endif
					<div class="row align-items-center text-center">
						<div class="col-lg-6 col-md-6 d-none d-md-block">
							<div class="social">
								<ul class="text-center m-0">
									@if(\LANMS\Info::where('name', 'social_facebook')->first()->content)<li><a class="social-icon" href="https://www.facebook.com/{{ \LANMS\Info::where('name', 'social_facebook')->first()->content }}"><i class="fab fa-facebook"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_twitter')->first()->content)<li><a class="social-icon" href="https://www.twitter.com/{{ \LANMS\Info::where('name', 'social_twitter')->first()->content }}"><i class="fab fa-twitter"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_instagram')->first()->content)<li><a class="social-icon" href="https://www.instagram.com/{{ \LANMS\Info::where('name', 'social_instagram')->first()->content }}"><i class="fab fa-instagram"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_youtube')->first()->content)<li><a class="social-icon" href="https://www.youtube.com/{{ \LANMS\Info::where('name', 'social_youtube')->first()->content }}"><i class="fab fa-youtube"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_snapchat')->first()->content)<li><a class="social-icon" href="https://www.snapchat.com/add/{{ \LANMS\Info::where('name', 'social_snapchat')->first()->content }}"><i class="fab fa-snapchat"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_twitch')->first()->content)<li><a class="social-icon" href="https://www.twitch.tv/{{ \LANMS\Info::where('name', 'social_twitch')->first()->content }}"><i class="fab fa-twitch"></i></a></li>@endif
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 text-right privacy"> <a href="{{ url('privacy') }}" class="btn btn-link">Privacy Policy</a> <a href="{{ url('tos') }}" class="btn btn-link">Terms of Service</a></div>
					</div>
					<div class="row align-items-center flex-row-reverse">
						<div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
							&copy; {{ Setting::get('WEB_COPYRIGHT') }} &middot; <i class="fa fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s &middot; <i class="fas fa-language"></i> {{ strtoupper(App::getLocale()) }}</small>
							<br>
							<a href="http://lanms.xyz/" target="_blank">{{ Setting::get('APP_NAME') }}</a> <a href="{{ Setting::get('APP_URL') }}">{{ Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> by <a href="https://infihex.com/" target="_blank">Infihex</a>
							<br>
							@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")<b class="text-danger">Unlicensed version of this software!</b>@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")<b class="text-danger">License has expired for this software!</b>@endif
							@if(Config::get('app.debug'))
								<b><span class="text-danger">DEBUG MODE</span></b>
							@endif
							@if(Config::get('app.debug') && Setting::get('SHOW_RESETDB'))
								<b>&middot; <a href="/resetdb" class="text-danger">RESET DB AND SETTINGS</a></b>
							@endif 
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->
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
			    "message": "This website uses cookies to ensure you get the best experience on our website. Do you accept this?",
			    "dismiss": "I ACCEPT",
			    "link": "Learn more",
			    "href": "{{ url('/privacy') }}"
			  }
			})});
		</script>

		<link href="{{ Theme::url('css/sponsorcarousel.css') }}" rel="stylesheet" />
		<script>

			$('#sponsorcarousel').on('slide.bs.carousel', function (e) {

			    var $e = $(e.relatedTarget);
			    var idx = $e.index();
			    var itemsPerSlide = 3;
			    var totalItems = $('.carousel-item').length;
			    
			    if (idx >= totalItems-(itemsPerSlide-1)) {
			        var it = itemsPerSlide - (totalItems - idx);
			        for (var i=0; i<it; i++) {
			            // append slides to end
			            if (e.direction=="left") {
			                $('.carousel-item').eq(i).appendTo('.carousel-inner');
			            }
			            else {
			                $('.carousel-item').eq(0).appendTo('.carousel-inner');
			            }
			        }
			    }
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

		@if(Setting::get('FACEBOOK_APP_ID') && Setting::get('FACEBOOK_PAGE_ID'))
			<script>
				window.fbAsyncInit = function() {
					FB.init({
						appId            : '{{ Setting::get('FACEBOOK_APP_ID') }}',
						autoLogAppEvents : true,
						xfbml            : true,
						version          : 'v2.12'
					});
				};
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<div class="fb-customerchat" page_id="{{ Setting::get('FACEBOOK_PAGE_ID') }}" theme_color="#0061da" logged_in_greeting="Hei, vi er her for å hjelpe deg! :)" logged_out_greeting="Hei, vi er her for å hjelpe deg! :)"></div>
		@endif

	</body>
</html>