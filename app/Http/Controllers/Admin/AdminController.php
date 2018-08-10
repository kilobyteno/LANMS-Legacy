<?php 

namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller {

	public function dashboard()
	{
		return view('dashboard');
	}

	public function whatsnew()
	{
		return view('whatsnew');
	}

	public function activity()
	{
		if (!Sentinel::getUser()->hasAccess(['admin.*'])) {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}

		$activity = Activity::where('properties', '<>', '{"attributes":[],"old":[]}')->get();
		return view('activity')->withActivities($activity);

	}

}
