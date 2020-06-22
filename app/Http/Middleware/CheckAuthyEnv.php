<?php

namespace LANMS\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class CheckAuthyEnv
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
        if (!env("AUTHY_SECRET")) {
            return redirect()->route('user-profile-edit', Sentinel::getUser()->username)
                        ->with('messagetype', 'warning')
                        ->with('message', __('user.profile.edit.settings.2fa.alert.missingenv'));
        }
        return $next($request);
    }
}
