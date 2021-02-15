<?php namespace LANMS\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\AppSetting;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests;
use LANMS\Http\Requests\Admin\SettingEditRequest;
use anlutro\LaravelSettings\Facade as Setting;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.settings.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $ignored = array("APP_LICENSE_KEY", "APP_LICENSE_LOCAL_KEY", "APP_LICENSE_STATUS", "APP_LICENSE_STATUS_DESC", "APP_NAME", "APP_VERSION", "APP_VERSION_TYPE", "APP_URL", "APP_SHOW_RESETDB", "APP_LICENSE_INFO_NAME", "APP_LICENSE_INFO_COMPANY", "APP_LICENSE_INFO_EMAIL", "APP_LICENSE_INFO_PRODUCTNAME", "APP_LICENSE_INFO_REGDATE", "APP_LICENSE_INFO_NEXTDUE", "APP_LICENSE_INFO_CYCLE", "APP_LICENSE_LAST_CHECKED", "APP_SCHEDULE_LAST_RUN");
        $settings = AppSetting::all()->except($ignored);
        return view('settings.index')->withSettings($settings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.settings.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $value = Setting::get($id);
        return view('settings.edit')->withKey($id)->withValue($value);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, SettingEditRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.settings.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        Setting::set($id, $request->value);
        Setting::save();
        return Redirect::route('admin-settings')
                ->with('messagetype', 'success')
                ->with('message', 'The setting has now been saved!');
    }
}
