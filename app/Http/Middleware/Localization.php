<?php

namespace LANMS\Http\Middleware;

use Closure;

class Localization
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
        if (\Sentinel::check()) {
            if (\Sentinel::getUser()->language) {
                $locale = \Sentinel::getUser()->language;
                if (in_array($locale, array_keys(config('app.locales')))) {
                    \Session::put('locale', $locale);
                    \App::setLocale($locale);
                    \Carbon::setLocale($locale);
                }
                return $next($request);
            }
        }

        // GUEST
        if (\Session::has('locale')) {
            $locale = \Session::get('locale');
            if (in_array($locale, array_keys(config('app.locales')))) {
                \App::setLocale($locale);
                \Carbon::setLocale($locale);
            }
        }
        
        return $next($request);
    }
}
