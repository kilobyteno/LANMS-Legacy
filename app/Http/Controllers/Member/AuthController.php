<?php

namespace LANMS\Http\Controllers\Member;

use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Redirect;
use LANMS\Act;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\Auth\ActivateRequest;
use LANMS\Http\Requests\Auth\SignInRequest;
use LANMS\Http\Requests\Auth\SignUpRequest;

class AuthController extends Controller
{
    public function getSignIn()
    {
        return view('auth.signin');
    }

    public function postSignIn(SignInRequest $request)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-signin')->with('messagetype', 'info')
                                ->with('message', trans('auth.alert.logindisabled'));
        }

        $username       = $request->input('username');
        $password       = $request->input('password');
        $remember       = $request->input('remember');

        $validated = $request->validated();

        if (!$validated) {
            return Redirect::route('account-signin')->with('messagetype', 'danger')
                                ->with('message', trans('auth.alert.usernotfound'))->withInput();
        }

        $credentials = ['login' => $username, 'password' => $password];
        $user = \Sentinel::findByCredentials($credentials);

        if ($user == null) {
            return Redirect::route('account-signin')->with('messagetype', 'danger')
                                ->with('message', trans('auth.alert.usernotfound'))->withInput();
        } else {
            if ($user->isAnonymized) {
                return Redirect::route('account-signin')->with('messagetype', 'danger')
                                    ->with('message', trans('auth.alert.isanonymized'))->withInput();
            }

            $actex = \Activation::exists($user);
            $actco = \Activation::completed($user);
            $active = false;
            if ($actex) {
                $active = false;
            } elseif ($actco) {
                $active = true;
            }

            if ($active === false) {
                return Redirect::route('account-signin')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.alert.usernotactive'));
            } elseif (\Reminder::exists($user)) {
                return Redirect::route('account-signin')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.alert.resetpassword'));
            } elseif ($active === true) {
                try {
                    if (!\Setting::get('LOGIN_ENABLED') && !$user->hasAccess(['admin'])) {
                        return Redirect::route('account-signin')->with('messagetype', 'info')
                                            ->with('message', trans('auth.alert.logindisabled'));
                    } elseif (\Sentinel::authenticate($credentials)) {
                        $login = \Sentinel::login($user, $remember);
                        if (!$login) {
                            return Redirect::route('account-signin')->with('messagetype', 'warning')
                                                ->with('message', trans('auth.alert.loginfailed'))->withInput();
                        } else {
                            return Redirect::route('account')->with('messagetype', 'success')
                                                ->with('message', trans('auth.alert.loggedin'));
                        }
                    } else {
                        return Redirect::route('account-signin')->with('messagetype', 'danger')
                                                ->with('message', trans('auth.alert.usernamepasswordwrong'))->withInput();
                    }
                } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
                    return Redirect::route('account-signin')->with('messagetype', 'danger')
                                        ->with('message', trans('auth.alert.accountnotactive'));
                } catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
                    $delay = $e->getDelay();
                    return Redirect::route('account-signin')->with('messagetype', 'danger')
                                        ->with('message', trans('auth.alert.throttle', ['delay' => $delay]));
                }
            }
        }
    }

    public function getSignUp()
    {
        return view('auth.signup');
    }

    public function postSignUp(SignUpRequest $request)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-signin')->with('messagetype', 'info')
                                ->with('message', trans('auth.alert.logindisabled'));
        }
        
        $email              = $request->input('email');
        $firstname          = $request->input('firstname');
        $lastname           = $request->input('lastname');
        $username           = $request->input('username');
        $password           = $request->input('password');
        $birthdate          = $request->input('birthdate');
        $phone              = $request->input('phone');

        $referral           = \Session::get('referral');
        $referral_code      = str_random(15);

        $checkusername      = \User::where('username', '=', $username)->first();
        $checkemail         = \User::where('email', '=', $email)->first();

        if (!is_null($checkusername)) {
            return Redirect::route('account-signup')->with('messagetype', 'warning')
                                ->with('message', trans('auth.alert.usernametaken'))->withInput();
        }

        if (!is_null($checkemail)) {
            return Redirect::route('account-signup')->with('messagetype', 'warning')
                                ->with('message', trans('auth.alert.emailtaken'))->withInput();
        }

        if (is_null($checkusername) && is_null($checkemail)) {
            $user = \Sentinel::register(array(
                'email'             => $email,
                'username'          => $username,
                'firstname'         => $firstname,
                'lastname'          => $lastname,
                'birthdate'         => $birthdate,
                'phone'             => $phone,
                'password'          => $password,
                'referral'          => $referral,
                'referral_code'     => $referral_code,
            ));

            if ($user) {
                $customer = \Stripe::customers()->create([
                    'email' => $user->email,
                    'name' => $user->firstname.' '.$user->lastname,
                ]);
                $stripecustomer             = new \LANMS\StripeCustomer;
                $stripecustomer->cus        = $customer['id'];
                $stripecustomer->user_id    = $user->id;
                $stripecustomer->save();

                $activation = \Activation::create($user);
                $activation_code = $activation->code;

                \Mail::send('emails.auth.activate', array('link' => \URL::route('account-activate', $activation_code), 'firstname' => $firstname), function ($message) use ($user) {
                    $message->to($user->email, $user->firstname)->subject(trans('email.auth.activate.title'));
                });

                if (count(\Mail::failures()) > 0) {
                    return Redirect::route('account-signup')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.alert.emailfailure'));
                }

                \Session::forget('referral'); //forget the referral

                return Redirect::route('account-signin')->with('messagetype', 'success')
                                    ->with('message', trans('auth.alert.accountcreated'));
            } else {
                return Redirect::route('account-signup')->with('messagetype', 'danger')
                                    ->with('message', trans('auth.alert.creationfailure'));
            }
        }
    }

    public function getLogout()
    {
        \Sentinel::logout();
        return Redirect::route('home')
                        ->with('messagetype', 'success')
                        ->with('message', trans('auth.alert.loggedout'));
    }

    public function getActivate($activation_code)
    {
        $act = Act::where('code', '=', $activation_code)->where('completed', '=', 0)->first();
        if ($act == null) {
            return Redirect::route('home')
                ->with('messagetype', 'warning')
                ->with('message', trans('auth.alert.activationfailure'));
        } else {
            return view('auth.activate')->with('activation_code', $activation_code);
        }
    }

    public function postActivate(ActivateRequest $request, $activation_code)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-activate')->with('messagetype', 'info')
                                ->with('message', trans('auth.alert.logindisabled'));
        }

        $username           = $request->input('username');
        $credentials        = ['login' => $username];
        $user               = \Sentinel::findByCredentials($credentials);

        if ($user == null) {
            return Redirect::route('account-activate', $activation_code)->with('messagetype', 'warning')
                                    ->with('message', trans('auth.alert.usernameactivationfailure'));
        } else {
            $activation = Act::where('code', '=', $activation_code)->where('user_id', '=', $user->id)->first();
            if ($activation == null) {
                return Redirect::route('account-activate', $activation_code)->with('messagetype', 'warning')
                                    ->with('message', trans('auth.alert.usernameactivationfailure'));
            } else {
                if (\Activation::complete($user, $activation_code)) {
                    return Redirect::route('account-signin')->with('messagetype', 'success')
                                    ->with('message', trans('auth.alert.accountactivated'));
                } else {
                    return Redirect::route('account-signin')->with('messagetype', 'danger')
                                    ->with('message', trans('auth.alert.accountactivationfailure'));
                }
            }
        }
    }
}
