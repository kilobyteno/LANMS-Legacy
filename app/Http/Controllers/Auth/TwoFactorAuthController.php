<?php

namespace LANMS\Http\Controllers\Auth;

use Authy\AuthyApi;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class TwoFactorAuthController extends Controller
{
    public function index()
    {
        return view('auth.2fa-verify');
    }

    public function verify(Request $request)
    {
        try {
            $data = $request->validate([
                'verification_code' => ['required', 'numeric'],
            ]);
            $authy_api = new AuthyApi(getenv("AUTHY_SECRET"));
            $res = $authy_api->verifyToken(Sentinel::getUser()->authy_id, $data['verification_code']);
            if ($res->bodyvar("success")) {
                session(['isVerified' => true]);
                return redirect()->route('account')->with('messagetype', 'success')
                                            ->with('message', trans('auth.alert.loggedin'));
            }
            return back()->with(['error' => $res->errors()->message]);
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }

    public function activate()
    {
        $user = Sentinel::getUser();
        if (!$user->authy_id) {
            $data = array();
            $authy_api = new AuthyApi(getenv("AUTHY_SECRET"));
            $phone_country = $user->phone_country;
            $authy_user = $authy_api->registerUser($user->email, $user->phone, \libphonenumber\PhoneNumberUtil::getInstance()->getCountryCodeForRegion(strtoupper(Sentinel::getUser()->phone_country)));
            if ($authy_user->ok()) {
                $data['authy_id'] = $authy_user->id();
                $user = Sentinel::update($user, $data);
                return redirect()->route('user-profile-edit', $user->username)
                        ->with('messagetype', 'success')
                        ->with('message', __('user.profile.edit.settings.2fa.alert.activated'));
            } else {
                $msg = "";
                foreach ($authy_user->errors() as $field => $message) {
                    $msg = "$message.";
                }
                return redirect()->route('user-profile-edit', $user->username)
                    ->with('messagetype', 'danger')
                    ->with('message', $msg);
            }
        }
    }

    public function deactivate()
    {
        $user = Sentinel::getUser();
        if ($user->authy_id) {
            $data = array();
            $authy_api = new AuthyApi(getenv("AUTHY_SECRET"));
            $authy_user = $authy_api->deleteUser($user->authy_id);
            $data['authy_id'] = null;
            $user = Sentinel::update($user, $data);
            session(['isVerified' => false]);
        }
        return redirect()->route('user-profile-edit', $user->username)
                    ->with('messagetype', 'warning')
                    ->with('message', __('user.profile.edit.settings.2fa.alert.deactivated'));
    }
}
