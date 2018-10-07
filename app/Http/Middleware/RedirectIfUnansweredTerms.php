<?php

namespace LANMS\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;

class RedirectIfUnansweredTerms
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
        if (\Sentinel::getUser()->accepted_gdpr === null or \Sentinel::getUser()->accepted_gdpr === 0) {
            return \Redirect::route('gdpr-terms');
        }

        return $next($request);
    }
}
