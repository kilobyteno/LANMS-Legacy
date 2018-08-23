<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use LANMS\Act;

use LANMS\Http\Requests\Auth\SignInRequest;

class AuthController extends Controller {

	public function getSignIn() {
		return view('auth.signin');
	}

	public function postSignIn(SignInRequest $request) {

		$username 		= $request->input('username');
		$password 		= $request->input('password');
		$remember 		= $request->input('remember');

		$validated = $request->validated();

		if(!$validated) {
			return Redirect::route('account-signin')->with('messagetype', 'error')
								->with('message', 'User was not found.')->withInput();
		}

		$credentials 	= ['login' => $username, 'password' => $password];
		$user = \Sentinel::findByCredentials($credentials);

		if ($user == null) {

			return Redirect::route('account-signin')->with('messagetype', 'error')
								->with('message', 'User was not found.')->withInput();

		} else {

			$actex = \Activation::exists($user);
			$actco = \Activation::completed($user);
			$active = false;
			if($actex) {
				$active = false;
			} elseif($actco) {
				$active = true;
			}

			if ($active === false) {

				return Redirect::route('account-signin')->with('messagetype', 'warning')
									->with('message', '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.');

			} elseif ($active === true) {

				try {
					if(!\Setting::get('LOGIN_ENABLED') && !$user->hasAccess(['admin'])) {

						return Redirect::route('account-signin')->with('messagetype', 'info')
											->with('message', 'Login and registration has been disabled at this moment. Please check back later!');

					} elseif(\Sentinel::authenticate($credentials)) {

						$login = \Sentinel::login($user, $remember);
						if(!$login) {

							return Redirect::route('account-signin')->with('messagetype', 'warning')
												->with('message', 'Could not log you in. Please try again.')->withInput();

						} else {

							return Redirect::route('account')->with('messagetype', 'success')
												->with('message', 'Welcome back!');

						}

					} else {

						return Redirect::route('account-signin')->with('messagetype', 'error')
												->with('message', 'Username or password was wrong. Please try again.')->withInput();

					}
				} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
					return Redirect::route('account-signin')->with('messagetype', 'error')
										->with('message', 'Account is not activated!');
				} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
					$delay = $e->getDelay();
					return Redirect::route('account-signin')->with('messagetype', 'error')
										->with('message', 'Your ip is blocked for '.$delay.' second(s).');
				}
				

			} 

		}

	}

	public function getSignUp() {
		return view('auth.signup');
	}
	public function getLogout() {
		\Sentinel::logout();
		return Redirect::route('home')
						->with('messagetype', 'success')
						->with('message', 'You have now been successfully been logged out!');
	}

	public function getActivate($activation_code) {
		$act = Act::where('code', '=', $activation_code)->where('completed', '=', 0)->first();
		if($act == null) {
			return Redirect::route('home')
				->with('messagetype', 'warning')
				->with('message', 'We couldn\'t find your activation code. Please try again.');
		} else {
			return view('auth.activate')->with('activation_code', $activation_code);
		}
	}

}
