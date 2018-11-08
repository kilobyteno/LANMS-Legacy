<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use LANMS\Act;

use LANMS\Http\Requests\Auth\SignInRequest;
use LANMS\Http\Requests\Auth\SignUpRequest;
use LANMS\Http\Requests\Auth\ActivateRequest;

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
                                ->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
        }

        $username       = $request->input('username');
        $password       = $request->input('password');
        $remember       = $request->input('remember');

        $validated = $request->validated();

        if (!$validated) {
            return Redirect::route('account-signin')->with('messagetype', 'danger')
                                ->with('message', 'User was not found.')->withInput();
        }

        $credentials = ['login' => $username, 'password' => $password];
        $user = \Sentinel::findByCredentials($credentials);

        if ($user == null) {
            return Redirect::route('account-signin')->with('messagetype', 'danger')
                                ->with('message', 'User was not found.')->withInput();
        } else {
            if ($user->isAnonymized) {
                return Redirect::route('account-signin')->with('messagetype', 'danger')
                                    ->with('message', 'This account has been deleted.')->withInput();
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
                                    ->with('message', 'Your user is not active! Please check your inbox for the activation email. Check the spam-folder too.');
            } elseif ($active === true) {
                try {
                    if (!\Setting::get('LOGIN_ENABLED') && !$user->hasAccess(['admin'])) {
                        return Redirect::route('account-signin')->with('messagetype', 'info')
                                            ->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
                    } elseif (\Sentinel::authenticate($credentials)) {
                        $login = \Sentinel::login($user, $remember);
                        if (!$login) {
                            return Redirect::route('account-signin')->with('messagetype', 'warning')
                                                ->with('message', 'Could not log you in. Please try again.')->withInput();
                        } else {
                            return Redirect::route('account')->with('messagetype', 'success')
                                                ->with('message', 'Welcome back!');
                        }
                    } else {
                        return Redirect::route('account-signin')->with('messagetype', 'danger')
                                                ->with('message', 'Username or password was wrong. Please try again.')->withInput();
                    }
                } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
                    return Redirect::route('account-signin')->with('messagetype', 'danger')
                                        ->with('message', 'Account is not activated!');
                } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
                    $delay = $e->getDelay();
                    return Redirect::route('account-signin')->with('messagetype', 'danger')
                                        ->with('message', 'Your ip is blocked for '.$delay.' second(s).');
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
                                ->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
        }
        
        $email              = $request->input('email');
        $firstname          = $request->input('firstname');
        $lastname           = $request->input('lastname');
        $username           = $request->input('username');
        $password           = $request->input('password');

        $originalDate       = $request->input('birthdate');
        $birthdate          = date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution

        $referral           = \Session::get('referral');
        $referral_code      = str_random(15);

        $checkusername      = \User::where('username', '=', $username)->first();
        $checkemail         = \User::where('email', '=', $email)->first();

        if (!is_null($checkusername)) {
            return Redirect::route('account-signup')->with('messagetype', 'warning')
                                ->with('message', 'Username is already taken.')->withInput();
        }

        if (!is_null($checkemail)) {
            return Redirect::route('account-signup')->with('messagetype', 'warning')
                                ->with('message', 'Email is already taken.')->withInput();
        }

        if (is_null($checkusername) && is_null($checkemail)) {
            $user = \Sentinel::register(array(
                'email'             => $email,
                'username'          => $username,
                'firstname'         => $firstname,
                'lastname'          => $lastname,
                'birthdate'         => $birthdate,
                'password'          => $password,
                'referral'          => $referral,
                'referral_code'     => $referral_code,
            ));

            if ($user) {
                $activation = \Activation::create($user);
                $activation_code = $activation->code;

                $status = 'success';

                \Mail::send('emails.auth.activate', array('link' => \URL::route('account-activate', $activation_code), 'firstname' => $firstname), function ($message) use ($user) {
                    $message->to($user->email, $user->firstname)->subject('Activate your account');
                });

                if (count(\Mail::failures()) > 0) {
                    return Redirect::route('account-signup')->with('messagetype', 'warning')
                                    ->with('message', 'Something went wrong while trying to send you an email. But you user has been registered.');
                }

                \Session::forget('referral'); //forget the referral

                return Redirect::route('account-signin')->with('messagetype', 'success')
                                    ->with('message', 'Your account has been created, check your email for the activation link. Double check the spam-folder.');
            } else {
                return Redirect::route('account-signup')->with('messagetype', 'danger')
                                    ->with('message', 'Something went wrong while trying to register your user.');
            }
        }
    }

    public function getLogout()
    {
        \Sentinel::logout();
        return Redirect::route('home')
                        ->with('messagetype', 'success')
                        ->with('message', 'You have now been successfully been logged out!');
    }

    public function getActivate($activation_code)
    {
        $act = Act::where('code', '=', $activation_code)->where('completed', '=', 0)->first();
        if ($act == null) {
            return Redirect::route('home')
                ->with('messagetype', 'warning')
                ->with('message', 'We couldn\'t find your activation code. Please try again.');
        } else {
            return view('auth.activate')->with('activation_code', $activation_code);
        }
    }

    public function postActivate(ActivateRequest $request, $activation_code)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-activate')->with('messagetype', 'info')
                                ->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
        }

        $username           = $request->input('username');
        $credentials        = ['login' => $username];
        $user               = \Sentinel::findByCredentials($credentials);

        if ($user == null) {
            return Redirect::route('account-activate', $activation_code)->with('messagetype', 'warning')
                                    ->with('message', 'Username and activation code does not match.');
        } else {
            $activation = Act::where('code', '=', $activation_code)->where('user_id', '=', $user->id)->first();
            if ($activation == null) {
                return Redirect::route('account-activate', $activation_code)->with('messagetype', 'warning')
                                    ->with('message', 'User and activation code does not match.');
            } else {
                if (\Activation::complete($user, $activation_code)) {
                    return Redirect::route('account-signin')->with('messagetype', 'success')
                                    ->with('message', 'Your account has been activated!');
                } else {
                    return Redirect::route('account-signin')->with('messagetype', 'danger')
                                    ->with('message', 'Something went wrong while activating your account. Please try again later.');
                }
            }
        }
    }
}
