<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use LANMS\Http\Requests\Auth\ForgotPasswordRequest;
use LANMS\Http\Requests\Auth\ResetPasswordRequest;
use LANMS\Http\Requests\Auth\ResendVerificationRequest;

use LANMS\Rem;

class RecoverController extends Controller
{
    use ResetsPasswords;

    public function getForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-forgot-password')->with('messagetype', 'info')
                                ->with('message', trans('auth.alert.logindisabled'));
        }

        $username = $request->input('username');
        $credentials    = ['login' => $username];
        $user = \Sentinel::findByCredentials($credentials);
        if ($user == null) {
            return Redirect::route('account-forgot-password')->with('messagetype', 'error')
                                    ->with('message', trans('auth.alert.usernotfound'));
        }

        $actex = \Activation::exists($user);
        $actco = \Activation::completed($user);
        $active = false;
        if ($actex) {
            $active = false;
        } elseif ($actco) {
            $active = true;
        }

        $remex = \Reminder::exists($user);
        $reminder = false;
        if ($remex) {
            $reminder = true;
        }

        if ($active == false) {
            return Redirect::route('account-forgot-password')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.forgot.alert.notactive'));
        } elseif ($reminder == true) {
            return Redirect::route('account-signin')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.forgot.alert.alreadyasked'));
        } elseif ($active == true && $reminder == false) {
            $reminder       = \Reminder::create($user);
            $reminder_code  = $reminder->code;

            \Mail::send(
                'emails.auth.forgot-password',
                array(
                    'link' => \URL::route('account-reset-password', $reminder_code),
                    'firstname' => $user->firstname,
                    'username' => $user->username,
                ),
                function ($message) use ($user) {
                    $message->to($user->email, $user->firstname)->subject(trans('email.auth.forgotpassword.title'));
                }
            );
            
            if (count(\Mail::failures()) > 0) {
                return Redirect::route('account-forgot-password')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.forgot.alert.emailfailure'));
            } else {
                return Redirect::route('account-forgot-password')->with('messagetype', 'success')
                                    ->with('message', trans('auth.forgot.alert.emailsuccess'));
            }
        }
    }

    public function getResetPassword($resetpassword_code)
    {
        $act = Rem::where('code', '=', $resetpassword_code)->where('completed', '=', 0)->first();
        if ($act == null) {
            return Redirect::route('home')
                ->with('messagetype', 'warning')
                ->with('message', trans('auth.reset.alert.noreminder'));
        } else {
            return view('auth.reset-password')->with('resetpassword_code', $resetpassword_code);
        }
    }

    public function postResetPassword(ResetPasswordRequest $request, $resetpassword_code)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'info')
                                ->with('message', trans('auth.alert.logindisabled'));
        }

        $act = Rem::where('code', '=', $resetpassword_code)->where('completed', '=', 0)->first();
        if ($act == null) {
            return Redirect::route('home')
                ->with('messagetype', 'warning')
                ->with('message', trans('auth.reset.alert.noreminder'));
        }

        $username           = $request->input('username');
        $password           = $request->input('password');
        $credentials        = ['login' => $username];
        $user               = \Sentinel::findByCredentials($credentials);

        if ($user == null) {
            return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'danger')
                                ->with('message', trans('auth.alert.usernotfound'));
        } elseif ($user->id != $act->user_id) {
            return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'danger')
                                ->with('message', trans('auth.reset.alert.nomatch'));
        } elseif (\Reminder::complete($user, $resetpassword_code, $password)) {
            return Redirect::route('account-signin')->with('messagetype', 'success')
                                    ->with('message', trans('auth.reset.alert.cansignin'));
        } else {
            return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'danger')
                                ->with('message', trans('auth.reset.alert.failure'));
        }
    }

    public function getResendVerification()
    {
        return view('auth.resendverification');
    }

    public function postResendVerification(ResendVerificationRequest $request)
    {
        if (!\Setting::get('LOGIN_ENABLED')) {
            return Redirect::route('account-resendverification')->with('messagetype', 'info')
                                ->with('message', trans('auth.alert.logindisabled'));
        }

        $user = \User::where('email', '=', $request->email)->first();
        if ($user == null) {
            return Redirect::route('account-resendverification')->with('messagetype', 'danger')
                                ->with('message', trans('auth.resend.alert.usernotfound'));
        } else {
            $activation = \Activation::exists($user);

            if ($activation == null) {
                return Redirect::route('account-resendverification')->with('messagetype', 'warning')
                                ->with('message', trans('auth.resend.alert.noactivations'));
            } elseif ($activation->completed == true) {
                return Redirect::route('account-resendverification')->with('messagetype', 'info')
                                ->with('message', trans('auth.resend.alert.activationcompleted'));
            } else {
                \Mail::send('emails.auth.activate', array('link' => \URL::route('account-activate', $activation->code), 'firstname' => $user->firstname), function ($message) use ($user) {
                    $message->to($user->email, $user->firstname)->subject(trans('email.activate.title'));
                });

                if (count(\Mail::failures()) > 0) {
                    return Redirect::route('account-forgot-password')->with('messagetype', 'warning')
                                    ->with('message', trans('auth.resend.alert.emailfailure'));
                } else {
                    return Redirect::route('account-resendverification')->with('messagetype', 'success')
                                    ->with('message', trans('auth.resend.alert.emailsuccess'));
                }
            }
        }
    }
}
