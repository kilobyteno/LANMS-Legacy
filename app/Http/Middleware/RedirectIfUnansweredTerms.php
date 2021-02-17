<?php

namespace LANMS\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
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
        if (Sentinel::getUser()->accepted_gdpr === null or Sentinel::getUser()->accepted_gdpr === 0) {
            return redirect()->route('gdpr-terms');
        }

        return $next($request);
    }
}
