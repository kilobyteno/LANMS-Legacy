<?php

namespace LANMS\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Schema;

class HttpsProtocol
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Schema::hasTable('settings')) {
            if (!$request->secure() && setting('WEB_PROTOCOL') == 'https') {
                return redirect()->secure($request->getRequestUri());
            }
        }
        return $next($request);
    }
}
