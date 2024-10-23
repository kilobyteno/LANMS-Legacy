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

    public function systeminfo()
    {
        return view('systeminfo');
    }

    public function logo()
    {
        return view('logo');
    }

    public function logo_dark()
    {
        $request = request();
        $this->validate($request, [
            'logo_dark' => 'required|image|mimes:png|max:2048',
        ]);
        $logo = $request->file('logo_dark');
        $logo->move(public_path('images'), 'logo_dark.png');
        \Setting::set('WEB_LOGO_DARK', '/images/logo_dark.png');
        \Setting::save();
        return Redirect::back()->with('messagetype', 'success')
                            ->with('message', 'Logo updated successfully!');
    }

    public function logo_light()
    {
        $request = request();
        $this->validate($request, [
            'logo_light' => 'required|image|mimes:png|max:2048',
        ]);
        $logo = $request->file('logo_light');
        $logo->move(public_path('images'), 'logo_light.png');
        \Setting::set('WEB_LOGO_LIGHT', '/images/logo_light.png');
        \Setting::save();
        return Redirect::back()->with('messagetype', 'success')
                            ->with('message', 'Logo updated successfully!');
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
            if (array_key_exists("old", $values)) {
                $activity->oldvalue = json_encode($values["old"]);
            } else {
                $activity->oldvalue = null;
            }
            if (array_key_exists("attributes", $values)) {
                $activity->newvalue = json_encode($values["attributes"]);
            } else {
                $activity->newvalue = null;
            }
        }
        return view('activity')->withActivities($activities);
    }
}
