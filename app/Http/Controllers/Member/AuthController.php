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

	public function postSignUp() {
		if(!Request::ajax()) {
			abort(403);
		}

		if(!Setting::get('LOGIN_ENABLED')) {
			$status = 'invalid';
			$msg = 'Login and registration has been disabled at this moment. Please check back later!';
		} else {

			$resp = array();

			$status = 'invalid';
			$msg = 'Something went wrong...';

			$email 				= Request::get('email');
			$firstname	 		= Request::get('firstname');
			$lastname 			= Request::get('lastname');
			$username 			= Request::get('username');
			$password 			= Request::get('password');

			$originalDate 		= Request::input('birthdate');
			$birthdate 			= date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution

			$referral			= Session::get('referral');
			$referral_code 		= str_random(15);

			$checkusername 		= User::where('username', '=', $username)->first();
			$checkemail 		= User::where('email', '=', $email)->first();

			if(!is_null($checkusername)) { 
				$status = 'invalid';
				$msg = 'Username is already taken.';
			}

			if(!is_null($checkemail)) { 
				$status = 'invalid';
				$msg = 'Email is already taken.';
			}

			if(is_null($checkusername) && is_null($checkemail)) {

				$user = Sentinel::register(array(
					'email' 			=> $email,
					'username'			=> $username,
					'firstname'			=> $firstname,
					'lastname'			=> $lastname,
					'birthdate'			=> $birthdate,
					'password'			=> $password,
					'referral'			=> $referral,
					'referral_code'		=> $referral_code,
				));

				if($user) {

					$activation = Activation::create($user);
					$activation_code = $activation->code;

					$status = 'success';

					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $activation_code), 'firstname' => $firstname), function($message) use ($user) {
						$message->to($user->email, $user->firstname)->subject('Activate your account');
					});

					if(count(Mail::failures()) > 0) {
						$status = 'invalid';
						$msg = 'Something went wrong while trying to send you an email.';
					}

					Session::forget('referral'); //forget the referral

				} else {
					$status = 'invalid';
					$msg = 'Something went wrong while trying to register your user.';
				}

			}

		}
		
		$resp['status'] = $status;
		$resp['msg'] = $msg;
		return Response::json($resp);
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
