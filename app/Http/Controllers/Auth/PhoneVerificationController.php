<?php

namespace LANMS\Http\Controllers\Auth;

use LANMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Authy\AuthyApi;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

class PhoneVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkauthyenv');
        $this->authyApi = new AuthyApi(env('AUTHY_SECRET'));
    }

    /**
     * Request phone verification via PhoneVerificationService.
     *
     * @param  array  $data
     * @return Illuminate\Support\Facades\Response;
     */
    public function startVerification()
    {
        if (Sentinel::getUser()->phone_verified_at) {
            return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                            ->with('messagetype', 'warning')
                            ->with('message', trans('user.account.verifyphone.alert.alreadyverified'));
        }
        if (is_null(Sentinel::getUser()->phone) && is_null(Sentinel::getUser()->phone_country)) {
            return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                            ->with('messagetype', 'warning')
                            ->with('message', trans('user.account.verifyphone.alert.nophone'));
        }
        try {
            $response = $this->authyApi->phoneVerificationStart(Sentinel::getUser()->phone, \libphonenumber\PhoneNumberUtil::getInstance()->getCountryCodeForRegion(strtoupper(Sentinel::getUser()->phone_country)), 'sms');
            if ($response->ok()) {
                return view('account.verifyphone');
            } else {
                return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                        ->with('messagetype', 'danger')
                        ->with('message', trans('user.account.verifyphone.alert.failed').' '.$response->message());
            }
        } catch (Exception $e) {
            return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                    ->with('messagetype', 'danger')
                    ->with('message', trans('user.account.verifyphone.alert.failed').' '.$e->getMessage());
        }
    }

    /**
     * Request phone verification via PhoneVerificationService.
     *
     * @param  array  $data
     * @return Illuminate\Support\Facades\Response;
     */
    public function verifyCode(Request $request)
    {
        if (Sentinel::getUser()->phone_verified_at) {
            return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                            ->with('messagetype', 'warning')
                            ->with('message', trans('user.account.verifyphone.alert.alreadyverified'));
        }
        if (is_null(Sentinel::getUser()->phone) && is_null(Sentinel::getUser()->phone_country)) {
            return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                            ->with('messagetype', 'warning')
                            ->with('message', trans('user.account.verifyphone.alert.nophone'));
        }
        $data = $request->all();
        $validator = Validator::make($data, [
            'code' => 'required|string|max:10'
        ]);
        extract($data);
        if ($validator->passes()) {
            try {
                $response = $this->authyApi->phoneVerificationCheck(Sentinel::getUser()->phone, \libphonenumber\PhoneNumberUtil::getInstance()->getCountryCodeForRegion(strtoupper(Sentinel::getUser()->phone_country)), $code, \App::getLocale());
                if ($response->ok()) {
                    Sentinel::update(Sentinel::getUser()->id, ['phone_verified_at' => \Carbon::now()]);
                    return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                        ->with('messagetype', 'success')
                        ->with('message', trans('user.account.verifyphone.alert.saved'));
                } else {
                    return Redirect::back()
                                    ->with('messagetype', 'danger')
                                    ->with('message', $response->message());
                }
            } catch (Exception $e) {
                return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
                        ->with('messagetype', 'danger')
                        ->with('message', trans('user.account.verifyphone.alert.failed').' '.$e->getMessage());
            }
        } else {
            return Redirect::back()->withErrors();
        }
    }
}
