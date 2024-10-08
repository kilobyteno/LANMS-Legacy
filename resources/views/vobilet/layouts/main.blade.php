<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

		<!-- Dashboard Css -->
		@if(Sentinel::check())
			@if(Sentinel::getUser()->theme)
				<link href="{{ Theme::url('css/dashboard-'.Sentinel::getUser()->theme.'.css') }}" rel="stylesheet" />
				<link href="{{ Theme::url('plugins/select2/select2.'.Sentinel::getUser()->theme.'.css') }}" rel="stylesheet">
			@else
				<link href="{{ Theme::url('css/dashboard-default.css') }}" rel="stylesheet" />
				<link href="{{ Theme::url('plugins/select2/select2.default.css') }}" rel="stylesheet">
			@endif
		@else
			<link href="{{ Theme::url('css/dashboard-default.css') }}" rel="stylesheet" />
		@endif
		@yield('css')
		<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="{{ Theme::url('plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

		<!---Font icons-->
		<link href="{{ Theme::url('plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
		@if(Setting::get('APP_LICENSE_STATUS') == "Invalid" || Setting::get('APP_LICENSE_STATUS') == "Expired" || Setting::get('APP_LICENSE_STATUS') == "Suspended")
			<style type="text/css">
				.header {
					background:#f5c6cb;
				}
				.text-light {
					color: #6b1110 !important;
				}
			</style>
		@endif
		@production
            <script defer data-domain="{{ request()->getHost() }}" src="https://plausible.io/js/plausible.js"></script>
        @endproduction
	</head>
	<body class="">
		<div id="global-loader"></div>
		<div class="page">
			<div class="page-main">
				<div class="header py-4">
					<div class="container">
						<div class="d-flex">
							<a class="header-brand" href="{{ route('home') }}">
								@if(Setting::get('WEB_LOGO_DARK') || Setting::get('WEB_LOGO_LIGHT'))
									<img src="@if(Sentinel::check()){{ Sentinel::getUser()->theme=='dark' ? Setting::get('WEB_LOGO_LIGHT') : Setting::get('WEB_LOGO_DARK') }} @else {{ Setting::get('WEB_LOGO_DARK') }}@endif" class="header-brand-img" alt="{{ Setting::get('WEB_NAME') }}">
								@else
									<h1>{{ Setting::get('WEB_NAME') ?? config('app.name', 'LANMS') }}</h1>
								@endif
							</a>
							<div class="d-flex order-lg-2 ml-auto">
								@if(Sentinel::Guest())
									<div class="d-none d-md-flex">
										<a href="{{ route('account-signin') }}" class="nav-link btn btn-sm btn-outline-primary mr-2"><i class="fas fa-sign-in-alt mr-2"></i>{{ __('auth.signin.button') }}</a>
										<a href="{{ route('account-signup') }}" class="nav-link btn btn-sm btn-outline-secondary"><i class="fas fa-pencil-alt mr-2"></i>{{ __('auth.signup.button') }}</a>
									</div>
								@else
									<div class="dropdown d-none d-md-flex">
										<a class="nav-link icon" data-toggle="dropdown">
											<i class="far fa-bell"></i>
											@if(Sentinel::getUser()->unreadNotifications->count() > 0)
												<span class="nav-unread badge badge-danger badge-pill">{{ Sentinel::getUser()->unreadNotifications->count() }}</span>
											@endif
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow notifications">
											@if(Sentinel::getUser()->unreadNotifications->count() > 1)
												<p class="text-center m-3"><a href="{{ route('user-notifications-dismissall') }}" class="btn btn-info btn-sm">{{ __('global.notification.dismissall') }}</a></p>
												<div class="dropdown-divider"></div>
											@endif
											@foreach (Sentinel::getUser()->unreadNotifications->take(5) as $notification)
											    <a href="{{ route($notification->data['route'], $notification->data['id']) }}" class="dropdown-item d-flex pb-3">
											    	@if($notification->type === 'LANMS\Notifications\InvoiceUnpaid')
														<div class="notifyimg bg-danger">
															<i class="fas fa-exclamation"></i>
														</div>
														<div class="message">
															<strong>{{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['date' => ucfirst(\Carbon::parse($notification->data['due_date'])->isoFormat('LL')), 'amount' => moneyFormat(floatval($notification->data['amount_due']/100), strtoupper($notification->data['currency']))]) }}</strong>
															<div class="small text-muted">{{ $notification->created_at->diffForHumans() }}<button class="btn btn-secondary btn-sm float-right" onclick="notificationDismiss('{{ route('user-notification-dismiss', $notification->id) }}')">{{ __('global.notification.dismiss') }}</button></div>
														</div>
													@elseif($notification->type === 'LANMS\Notifications\SeatReservationExpires')
														<div class="notifyimg bg-warning">
															<i class="fas fa-chair"></i>
														</div>
														<div class="message">
															<strong>{{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['seatname' => strtoupper($notification->data['id'])]) }}</strong>
															<div class="small text-muted">{{ $notification->created_at->diffForHumans() }}<button class="btn btn-secondary btn-sm float-right" onclick="notificationDismiss('{{ route('user-notification-dismiss', $notification->id) }}')">{{ __('global.notification.dismiss') }}</button></div>
														</div>
													@elseif($notification->type === 'LANMS\Notifications\SeatReservationExpired')
														<div class="notifyimg bg-danger">
															<i class="fas fa-chair"></i>
														</div>
														<div class="message">
															<strong>{{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['seatname' => strtoupper($notification->data['id'])]) }}</strong>
															<div class="small text-muted">{{ $notification->created_at->diffForHumans() }}<button class="btn btn-secondary btn-sm float-right" onclick="notificationDismiss('{{ route('user-notification-dismiss', $notification->id) }}')">{{ __('global.notification.dismiss') }}</button></div>
														</div>
													@elseif($notification->type === 'LANMS\Notifications\CompoTeamAdded' || $notification->type === 'LANMS\Notifications\CompoTeamRemoved')
														<div class="notifyimg bg-info">
															<i class="fas fa-user-shield"></i>
														</div>
														<div class="message">
															<strong>{{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1)), ['team' => $notification->data['teamname'], 'user' => $notification->data['user']]) }}</strong>
															<div class="small text-muted">{{ $notification->created_at->diffForHumans() }}<button class="btn btn-secondary btn-sm float-right" onclick="notificationDismiss('{{ route('user-notification-dismiss', $notification->id) }}')">{{ __('global.notification.dismiss') }}</button></div>
														</div>
													@else
														<div class="notifyimg bg-info">
															<i class="fas fa-info"></i>
														</div>
														<div>
														<strong>{{ __('global.notification.'.strtolower(substr(strrchr($notification->type, '\\'), 1))) }}</strong>
															<div class="small text-muted">{{ $notification->created_at->diffForHumans() }}</div>
														</div>
													@endif
												</a>
											@endforeach
											@if(Sentinel::getUser()->unreadNotifications->count() === 0)
												<p class="dropdown-item text-center text-muted-dark m-0">{{ __('global.notification.nothing') }}</p>
											@endif
											<div class="dropdown-divider"></div>
											<a href="{{ route('user-notifications') }}" class="dropdown-item text-center text-muted-dark">{{ __('global.notification.viewall') }}</a>
										</div>
									</div>
									<div class="dropdown">
										<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
											<span class="avatar avatar-md brround" style="background-image: url({{ Sentinel::getUser()->profilepicturesmall ?? '/images/profilepicture/0_small.png' }})"></span>
											<span class="ml-2 d-none d-lg-block">
												<span class="@if(Sentinel::check()){{ Sentinel::getUser()->theme == 'dark' ? 'text-light' : 'text-dark' }}@endif" id="usermenu">{{ Sentinel::getUser()->firstname }}@if(Sentinel::getUser()->showname && Sentinel::getUser()->lastname) {{ Sentinel::getUser()->lastname }}@endif <i class="fas fa-caret-down"></i></span>
											</span>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
											@if(Sentinel::hasAccess('admin'))
												<a class="dropdown-item" href="{{ route('admin') }}">
													<i class="fa fa-user-secret"></i> {{ __('user.adminpanel') }}
												</a>
												<div class="dropdown-divider"></div>
											@endif
											<a class="dropdown-item" href="{{ route('members') }}">
												<i class="fas fa-users"></i> {{ __('header.members') }}
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('account') }}">
												<i class="fas fa-id-card"></i> {{ __('user.account.title') }}
											</a>
											<a class="dropdown-item" href="{{ route('user-profile', Sentinel::getUser()->username) }}">
												<i class="fas fa-user-circle"></i> {{ __('user.profile.title') }}
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('logout') }}">
												<i class="fas fa-sign-out-alt"></i> {{ __('auth.signout') }}
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
												<a class="nav-link" href="{{ route('account-signin') }}"><i class="fas fa-sign-in-alt mr-2"></i>{{ __('auth.signin.button') }}</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="{{ route('account-signup') }}"><i class="fas fa-pencil-alt mr-2"></i>{{ __('auth.signup.button') }}</a>
											</li>
										</div>
									@endif
									<li class="nav-item">
										<a class="nav-link @if(Request::is('/')){{'active'}} @endif" href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('header.home') }}</a>
									</li>
									@if(\LANMS\Page::forMenu()->count() > 0)
										<li class="nav-item">
											<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fas fa-info"></i> {{ __('header.information') }}</a>
											<div class="dropdown-menu dropdown-menu-arrow">
												<a class="dropdown-item @if(Request::is('news*')){{'active'}} @endif" href="{{ route('news') }}"><i class="far fa-newspaper"></i> {{ __('header.news') }}</a>
												<a class="dropdown-item @if(Request::is('tickets*')){{'active'}} @endif" href="{{ route('tickets') }}"><i class="fas fa-ticket-alt"></i> {{ __('header.tickets') }}</a>
												@if(Setting::get('HEADER_INFO_CONSENT_FORM'))
													<a class="dropdown-item @if(Request::is('consentform*')){{'active'}} @endif" href="{{ route('consentform') }}"><i class="fas fa-user-tie"></i> {{ __('global.download') .' '. __('seating.reservation.consentform.title') }}</a>
												@endif
												<div class="dropdown-divider"></div>
												@foreach(\LANMS\Page::forMenu() as $page)
													<a class="dropdown-item @if(Request::is($page->slug)){{'active'}} @endif" href="{{ route('page', $page->slug) }}">{{ $page->title }}</a>
												@endforeach
											</div>
										</li>
									@endif
									<li class="nav-item">
										<a class="nav-link @if(Request::is('schedule')){{'active'}} @endif" href="{{ route('schedule') }}"><i class="fas fa-calendar-week"></i> {{ __('header.schedule') }}</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('compo*') || Request::is('user/compo*')){{'active'}} @endif" href="{{ route('compo') }}"><i class="fas fa-compress-arrows-alt"></i> {{ __('header.compo') }}</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('user/seating*')){{'active'}} @endif" href="{{ route('seating') }}"><i class="fas fa-chair"></i> {{ __('header.seating') }}</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('crew')){{'active'}} @endif" href="{{ route('crew') }}"><i class="fas fa-crown"></i> {{ __('header.crew') }}</a>
									</li>
									<li class="nav-item">
										<a class="nav-link @if(Request::is('sponsor')){{'active'}} @endif" href="{{ route('sponsor') }}"><i class="fas fa-money-check-alt"></i> {{ __('header.sponsor') }}</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="my-3 my-md-5">
					<div class="container">
						@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")
							<div class="alert alert-danger" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(__('global.alert.important')) }}!</strong> Unlicensed version of this software! The system administrator needs to update the license.</div>
						@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")
							<div class="alert alert-danger" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(__('global.alert.important')) }}!</strong> Your license has expired! Please contact your provider.</div>
						@elseif(Setting::get('APP_LICENSE_STATUS') == "Suspended")
							<div class="alert alert-danger" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(__('global.alert.important')) }}!</strong> License has been suspended for this software!</strong>
							</div>
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
			</div>

			<!--footer-->
			<footer class="footer br-bl-7 br-br-7">
				<div class="container">
					@if(Setting::get('APP_LICENSE_STATUS') == "Invalid")
						<div class="alert alert-danger text-center" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(__('global.alert.important')) }}!</strong> Unlicensed version of this software! The system administrator needs to update the license.</div>
					@elseif(Setting::get('APP_LICENSE_STATUS') == "Expired")
						<div class="alert alert-danger text-center" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(__('global.alert.important')) }}!</strong> Your license has expired! Please contact your provider.</div>
					@elseif(Setting::get('APP_LICENSE_STATUS') == "Suspended")
						<div class="alert alert-danger text-center" role="alert"><i class="far fa-frown mr-1"></i> <strong>{{ mb_strtoupper(__('global.alert.important')) }}!</strong> License has been suspended for this software!</strong>
						</div>
					@endif
					@if(count(LANMS\Sponsor::thisYear()->get()) > 0)
						<div class="row">
							<div class="col-lg-12">
								<div id="sponsorcarousel" class="carousel slide mb-5 mt-2" data-ride="carousel" data-interval="3000">
							        <div class="carousel-inner row w-100 mx-auto" role="listbox">
							        	@foreach(LANMS\Sponsor::ordered()->thisYear()->get() as $sponsor)
								            <div class="carousel-item col-md-4 @if($sponsor->sort_order == 0) active @endif">
								                <a href="{{ $sponsor->url }}"><img class="img-fluid mx-auto d-block" src="@if(Sentinel::check()){{ (Sentinel::getUser()->theme == 'dark') ? ($sponsor->image_light) : asset($sponsor->image_dark) }} @else {{ $sponsor->image_dark }}@endif" alt="{{ $sponsor->name }}"></a>
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
									@if(\LANMS\Info::where('name', 'social_facebook')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://www.facebook.com/{{ \LANMS\Info::where('name', 'social_facebook')->first()->content }}"><i class="fab fa-facebook"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_twitter')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://www.twitter.com/{{ \LANMS\Info::where('name', 'social_twitter')->first()->content }}"><i class="fab fa-twitter"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_instagram')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://www.instagram.com/{{ \LANMS\Info::where('name', 'social_instagram')->first()->content }}"><i class="fab fa-instagram"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_youtube')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://www.youtube.com/{{ \LANMS\Info::where('name', 'social_youtube')->first()->content }}"><i class="fab fa-youtube"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_snapchat')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://www.snapchat.com/add/{{ \LANMS\Info::where('name', 'social_snapchat')->first()->content }}"><i class="fab fa-snapchat"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_twitch')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://www.twitch.tv/{{ \LANMS\Info::where('name', 'social_twitch')->first()->content }}"><i class="fab fa-twitch"></i></a></li>@endif
									@if(\LANMS\Info::where('name', 'social_discord')->where('content', '<>', '')->first())<li><a class="social-icon" href="https://discord.me/{{ \LANMS\Info::where('name', 'social_discord')->first()->content }}"><i class="fab fa-discord"></i></a></li>@endif
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 text-right privacy"> <a href="{{ url('privacy') }}" class="btn btn-link">{{ __('footer.privacypolicy') }}</a> <a href="{{ url('tos') }}" class="btn btn-link">{{ __('footer.termsofservice') }}</a></div>
					</div>
					<div class="row align-items-center flex-row-reverse">
						<div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
							&copy; {{ Setting::get('WEB_COPYRIGHT') }} &middot; <i class="fa fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
							<br>
							<div class="text-center mt-3 mb-3">
								<div class="dropup btn-group">
									<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fas fa-language"></i> {{ mb_strtoupper(App::getLocale()) }}<span class="caret"></span></button>
									<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
										@foreach(array_flip(config('app.locales')) as $lang)
											<li><a href="{{ route('locale', $lang) }}">{{ __('language.'.$lang) }}</a></li>
										@endforeach
									</ul>
								</div>
								@if(Sentinel::check())
									<a class="btn btn-secondary btn-sm" href="{{ route('theme') }}"><i class="fas fa-adjust"></i></a>
								@endif
							</div>
							<p class="mt-2"><a href="http://lanms.net/" target="_blank">{{ Setting::get('APP_NAME') }}</a> <a href="{{ Setting::get('APP_URL') }}">{{ Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> {{ __('global.by') }} <a href="https://kilobyte.no/" target="_blank">Kilobyte AS</a></p>
							@if(Config::get('app.debug'))
								<b><span class="text-danger">{{ mb_strtoupper(__('footer.debugmode')) }}</span></b>
							@endif
							@if(Config::get('app.debug') && Setting::get('APP_SHOW_RESETDB'))
								<b>&middot; <a href="/resetdb" class="text-danger">{{ mb_strtoupper(__('footer.resetdbandsettings')) }}</a></b>
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
		<script src="{{ Theme::url('plugins/select2/select2.full.min.js') }}"></script>

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

		<script type="text/javascript">
			$('#usermenu').click(function() {
				$("i", this).toggleClass("fa-caret-up fa-caret-down");
			});
			function notificationDismiss (url) {
				event.preventDefault();
				window.location.href = url;
			}
		</script>

		@if(Setting::get('FACEBOOK_MESSENGER_APP_ID') && Setting::get('FACEBOOK_MESSENGER_PAGE_ID'))
			<script>
				window.fbAsyncInit = function() {
					FB.init({
						appId            : '{{ Setting::get('FACEBOOK_MESSENGER_APP_ID') }}',
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
			<div class="fb-customerchat" page_id="{{ Setting::get('FACEBOOK_MESSENGER_PAGE_ID') }}" theme_color="#0061da" logged_in_greeting="{{ __('global.facebookmessenger.logged_in_greeting') }}" logged_out_greeting="{{ __('global.facebookmessenger.logged_out_greeting') }}"></div>
		@endif

	</body>
</html>