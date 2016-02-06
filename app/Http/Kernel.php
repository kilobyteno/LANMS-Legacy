<?php namespace LANMS\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'LANMS\Http\Middleware\VerifyCsrfToken',
		'LANMS\Http\Middleware\HttpsProtocol', // FORCE HTTPS
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'sentinel.auth' => 'LANMS\Http\Middleware\SentinelAuth',
		'sentinel.guest' => 'LANMS\Http\Middleware\SentinelGuest',
		'sentinel.admin' => 'LANMS\Http\Middleware\SentinelAdmin',
	];

}
