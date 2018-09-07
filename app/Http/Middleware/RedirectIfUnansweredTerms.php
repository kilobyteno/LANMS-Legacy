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
        if (\Sentinel::getUser()->accepted_gdpr === null) {
            return redirect('gdpr/show_terms');
        }

        return $next($request);
    }
}
