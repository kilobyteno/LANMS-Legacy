<?php namespace LANMS\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SentinelAuth {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Sentinel::guest())
		{
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->route('account-signin')
										->with('messagetype', 'info')
                                        ->with('message', trans('global.noaccess'));
			}
		} else {
			$now = date_create('now');
			$user = Sentinel::findById(Sentinel::getUser()->id);
			$details = [
				'last_activity' => $now
			];
			Sentinel::update($user, $details);
		}

		return $next($request);
	}

}
