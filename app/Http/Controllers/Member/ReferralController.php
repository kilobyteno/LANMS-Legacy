<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use anlutro\LaravelSettings\Facade as Setting;

use Illuminate\Http\Request;

class ReferralController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $code): \Illuminate\Http\RedirectResponse
    {
        if (Setting::get('REFERRAL_ACTIVE')) {
            $request->session()->put('referral', $code);
            return Redirect::route('account-signup');
        } else {
            return Redirect::route('home');
        }
    }
}
