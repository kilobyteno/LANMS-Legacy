<?php

namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
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

        $activities = Activity::where('properties', '<>', '{"attributes":[],"old":[]}')->where('causer_id', '<>', '')->where('causer_type', '<>', '')->get();
        foreach ($activities as $activity) {
            $values = json_decode($activity->properties, true);
            $activity->oldvalue = json_encode($values["old"]);
            $activity->newvalue = json_encode($values["attributes"]);
        }
        return view('activity')->withActivities($activities);
    }
}
