<?php

namespace LANMS\Http\Middleware;

use Closure;

class CheckTwilioEnv
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
        if (!env('TWILIO_SID') || !env('TWILIO_TOKEN')) {
            return redirect()->back()
                        ->with('messagetype', 'danger')
                        ->with('message', "TWILIO ENVIRONMENT KEYS IS MISSING!");
        }
        return $next($request);
    }
}
