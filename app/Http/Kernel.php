<?php

namespace LANMS\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \LANMS\Http\Middleware\TrustHosts::class,
        \LANMS\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \LANMS\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \LANMS\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \LANMS\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \LANMS\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \LANMS\Http\Middleware\Localization::class,
            \LANMS\Http\Middleware\HttpsProtocol::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \LANMS\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'sentinel.auth' => \LANMS\Http\Middleware\SentinelAuth::class,
        'sentinel.guest' => \LANMS\Http\Middleware\SentinelGuest::class,
        'sentinel.admin' => \LANMS\Http\Middleware\SentinelAdmin::class,
        'setTheme' => \Igaster\LaravelTheme\Middleware\setTheme::class,
        'gdpr.terms' => \LANMS\Http\Middleware\RedirectIfUnansweredTerms::class,
        'ajax.check' => \LANMS\Http\Middleware\AjaxCheck::class,
        'client' =>  \Laravel\Passport\Http\Middleware\CheckClientCredentials::class,
        'checkauthyenv' => \LANMS\Http\Middleware\CheckAuthyEnv::class,
        'checktwilioenv' => \LANMS\Http\Middleware\CheckTwilioEnv::class,
    ];
}
