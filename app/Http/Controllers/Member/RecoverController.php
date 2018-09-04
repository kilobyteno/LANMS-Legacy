<?php namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use LANMS\Http\Requests\Auth\ForgotPasswordRequest;
use LANMS\Http\Requests\Auth\ResetPasswordRequest;

use LANMS\Rem;

class RecoverController extends Controller {

	use ResetsPasswords;

	public function getForgotPassword() {
		return view('auth.forgot-password');
	}

	public function postForgotPassword(ForgotPasswordRequest $request) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-forgot-password')->with('messagetype', 'info')
								->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		}

		$username = $request->input('username');
		$credentials 	= ['login' => $username];
		$user = \Sentinel::findByCredentials($credentials);
		if ($user == null) {
			return Redirect::route('account-forgot-password')->with('messagetype', 'error')
									->with('message', 'Your user is not found!');
		}

		$actex = \Activation::exists($user);
		$actco = \Activation::completed($user);
		$active = false;
		if($actex) {
			$active = false;
		} elseif($actco) {
			$active = true;
		}

		$remex = \Reminder::exists($user);
		$reminder = false;
		if($remex) {
			$reminder = true;
		}

		if ($active == false) {

			return Redirect::route('account-forgot-password')->with('messagetype', 'warning')
									->with('message', 'Your user is not active! Please check your inbox for the activation email. Check the spam-folder too.');

		} elseif ($reminder == true) {

			return Redirect::route('account-signin')->with('messagetype', 'warning')
									->with('message', 'You have already asked for a reminder! Please check your inbox for the activation email. Check the spam-folder too.');

		} elseif ($active == true && $reminder == false) {

			$reminder 		= \Reminder::create($user);
			$reminder_code 	= $reminder->code;

			\Mail::send('emails.auth.forgot-password', 
				array(
					'link' => \URL::route('account-recover', $reminder_code),
					'firstname' => $user->firstname,
					'username' => $user->username,
				), function($message) use ($user) {
					$message->to($user->email, $user->firstname)->subject('Forgot Password');
			});
			
			if(count(\Mail::failures()) > 0) {
				return Redirect::route('account-forgot-password')->with('messagetype', 'warning')
									->with('message', 'Something went wrong while trying to send you an email.');
			} else {
				return Redirect::route('account-forgot-password')->with('messagetype', 'success')
									->with('message', 'Check your email for the reset password link. Double check the spam-folder.');
			}
		}
	}

	public function getResetPassword($resetpassword_code) {
		$act = Rem::where('code', '=', $resetpassword_code)->where('completed', '=', 0)->first();
		if($act == null) {
			return Redirect::route('home')
				->with('messagetype', 'warning')
				->with('message', 'We couldn\'t find your reminder code. Please try again.');
		} else {
			return view('auth.reset-password')->with('resetpassword_code', $resetpassword_code);
		}

	}

	public function postResetPassword(ResetPasswordRequest $request, $resetpassword_code) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'info')
								->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		}

		$act = Rem::where('code', '=', $resetpassword_code)->where('completed', '=', 0)->first();
		if($act == null) {
			return Redirect::route('home')
				->with('messagetype', 'warning')
				->with('message', 'We couldn\'t find your reminder code. Please try again.');
		}

		$username 			= $request->input('username');
		$password 			= $request->input('password');
		$credentials 		= ['login' => $username];
		$user 				= \Sentinel::findByCredentials($credentials);

		if($user == null) {
			return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'danger')
								->with('message', 'Your user is not found!');
		} elseif($user->id != $act->user_id) {
			return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'danger')
								->with('message', 'Username does not match the code!');
		} elseif (\Reminder::complete($user, $resetpassword_code, $password)) {
			return Redirect::route('account-signin')->with('messagetype', 'success')
									->with('message', 'You can now sign in!');
		} else {
			return Redirect::route('account-reset-password', $resetpassword_code)->with('messagetype', 'danger')
								->with('message', 'Something went wrong while reseting your password. Please try again later.');
		}

	}

	public function getResendVerification() {
		return view('auth.resendverification');
	}

}
