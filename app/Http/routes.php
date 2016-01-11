<?php

/*
| DEBUG ONLY
*/
if(Config::get('app.debug')) {
	Route::get('/resetdb', function() {
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		#Artisan::call('migrate --package=vendor/regulus/activity-log');
		Artisan::call('db:seed');
		return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
	});
	/*Route::get('/mailtest', function() {
		Mail::send('emails.activate', ['link'=>'derp','firstname'=>'Daniel'], function($message) {
			$message->to("daniel@retardedtech.com", "Daniel")->subject('Test Email');
		});
		if(count(Mail::failures()) > 0) {
			dd('Mail Failure.');
		} else {
			dd('Success.');
		}
	});*/
	Route::get('/test', function() {
		echo 'Hello.';
	});
}

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/tos', ['as' => 'account-tos', 'uses' => 'HomeController@index']);
Route::get('/privacy', ['as' => 'account-privacy', 'uses' => 'HomeController@index']);

Route::group([
	'prefix' => 'news'
	], function() {
		get('/', [
			'as' => 'news',
			'uses' => 'News\NewsController@index'
		]);
		get('/{slug}', [
			'as' => 'news-show',
			'uses' => 'News\NewsController@show'
		]);
		get('/category/{slug}', [
			'as' => 'news-category-show',
			'uses' => 'News\NewsCategoryController@show'
		]);
});


Route::group([
	'middleware' => 'sentinel.guest',
	'prefix' => 'account',
	], function() {
		get('/forgot/password', [
			'as' => 'account-forgot-password' ,
			'uses' => 'Member\RecoverController@getForgotPassword'
		]);
		get('/resetpassword/{code}', [
			'as' => 'account-recover' ,
			'uses' => 'Member\RecoverController@getResetPassword'
		]);
		get('/register', [
			'as' => 'account-register',
			'uses' => 'Member\AuthController@getRegister'
		]);
		get('/login', [
			'as' => 'account-login',
			'uses' => 'Member\AuthController@getLogin'
		]);
		get('/activate/{activation_code}', [
			'as' => 'account-activate',
			'uses' => 'Member\AuthController@getActivate'
		]);
});

Route::group([
	'middleware' => 'sentinel.auth',
	'prefix' => 'user',
	], function() {
		get('/', [
			'as' => 'account' ,
			'uses' => 'Member\AccountController@index'
		]);
		get('/settings', [
			'as' => 'account-settings' ,
			'uses' => 'Member\AccountController@getSettings'
		]);
		post('/settings', [
			'as' => 'account-settings-post' ,
			'uses' => 'Member\AccountController@postSettings'
		]);
		get('/change/password', [
			'as' => 'account-change-password' ,
			'uses' => 'Member\AccountController@getChangePassword'
		]);
		post('/change/password', [
			'as' => 'account-change-password-post' ,
			'uses' => 'Member\AccountController@postChangePassword'
		]);
		get('/change/details', [
			'as' => 'account-change-details' ,
			'uses' => 'Member\AccountController@getChangeDetails'
		]);
		post('/change/details', [
			'as' => 'account-change-details-post' ,
			'uses' => 'Member\AccountController@postChangeDetails'
		]);
		get('/change/images', [
			'as' => 'account-change-images' ,
			'uses' => 'Member\AccountController@getChangeImages'
		]);
		post('/change/images/profile', [
			'as' => 'account-change-image-profile-post' ,
			'uses' => 'Member\AccountController@postChangeProfileImage'
		]);
		post('/change/images/cover', [
			'as' => 'account-change-image-cover-post' ,
			'uses' => 'Member\AccountController@postChangeProfileCover'
		]);
		get('/logout', [
			'as' => 'logout',
			'uses' => 'Member\AuthController@getLogout'
		]);
		get('/profile/{username}', [
			'as' => 'user-profile',
			'uses' => 'Member\ProfileController@index'
		]);
		get('/members', [
			'as' => 'members',
			'uses' => 'Member\ProfileController@getMembers'
		]);
});

// ADMIN PANEL
Route::group([
	'middleware' => ['sentinel.auth','sentinel.admin'],
	'prefix' => 'admin',
	], function() {
		get('/', [
			'as' => 'admin' ,
			'uses' => 'HomeController@index'
		]);
		Route::group([
			'prefix' => 'news'
			], function() {
				get('/', [
					'as' => 'admin-news',
					'uses' => 'News\NewsController@admin'
				]);
				get('/create', [
					'as' => 'admin-news-create',
					'uses' => 'News\NewsController@create'
				]);
				post('/store', [
					'as' => 'admin-news-store',
					'uses' => 'News\NewsController@store'
				]);
				get('/{id}/edit', [
					'as' => 'admin-news-edit',
					'uses' => 'News\NewsController@edit'
				]);
				post('/{id}/update', [
					'as' => 'admin-news-update',
					'uses' => 'News\NewsController@update'
				]);
				get('/{id}/destroy', [
					'as' => 'admin-news-destroy',
					'uses' => 'News\NewsController@destroy'
				]);
				Route::group([
					'prefix' => 'categories'
					], function() {
						get('/', [
							'as' => 'admin-news-category',
							'uses' => 'News\NewsCategoryController@admin'
						]);
						get('/create', [
							'as' => 'admin-news-category-create',
							'uses' => 'News\NewsCategoryController@create'
						]);
						post('/store', [
							'as' => 'admin-news-category-store',
							'uses' => 'News\NewsCategoryController@store'
						]);
						get('/{id}/edit', [
							'as' => 'admin-news-category-edit',
							'uses' => 'News\NewsCategoryController@edit'
						]);
						post('/{id}/update', [
							'as' => 'admin-news-category-update',
							'uses' => 'News\NewsCategoryController@update'
						]);
						get('/{id}/destroy', [
							'as' => 'admin-news-category-destroy',
							'uses' => 'News\NewsCategoryController@destroy'
						]);
				});
		});
		Route::group([
			'prefix' => 'settings'
			], function() {
				get('/', [
					'as' => 'admin-settings',
					'uses' => 'Admin\SettingsController@index'
				]);
				get('/{id}/edit', [
					'as' => 'admin-settings-edit',
					'uses' => 'Admin\SettingsController@edit'
				]);
				post('/{id}/update', [
					'as' => 'admin-settings-update',
					'uses' => 'Admin\SettingsController@update'
				]);
		});
});

Route::group(['prefix' => 'ajax',], function() {
	Route::post('/account/register', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();

		$reg_status = 'invalid';
		$reg_msg = 'Something went wrong...';

		$email 				= Request::get('email');
		$firstname	 		= Request::get('firstname');
		$lastname 			= Request::get('lastname');
		$username 			= Request::get('username');
		$password 			= Request::get('password');

		$originalDate 		= Request::input('birthdate');
		$birthdate 			= date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution

		$referral			= Request::get('referral');
		$referral_code 		= str_random(15);

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

			$reg_status = 'success';

			Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $activation_code), 'firstname' => $firstname), function($message) use ($user) {
				$message->to($user->email, $user->firstname)->subject('Activate your account');
			});

			if(count(Mail::failures()) > 0) {
				$reg_status = 'invalid';
				$reg_msg = 'Something went wrong while trying to send you an email.';
			}

			Session::forget('referral'); //forget the referral

		} else {
			$reg_status = 'invalid';
			$reg_msg = 'Something went wrong while trying to register your user.';
		}

		
		$resp['reg_status'] = $reg_status;
		$resp['reg_msg'] = $reg_msg;
		return Response::json($resp);
	});
	Route::post('/account/activate', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp 				= array();
		$activation_status 	= 'invalid';
		$activation_msg 	= 'Something went wrong...';

		$username 			= Request::input('username');
		$activation_code	= Request::input('activation_code');
		$credentials 		= ['login' => $username];
		$user 				= Sentinel::findByCredentials($credentials);

		if (Activation::complete($user, $activation_code)) {
			$activation_status 		= 'success';
			$resp['redirect_url'] 	= URL::route('account-login');
		} else {
			$activation_msg 		= 'Something went wrong while activating your account. Please try again later.';
		}

		$resp['activation_status'] 	= $activation_status;
		$resp['activation_msg'] 	= $activation_msg;

		return Response::json($resp);

	});
	Route::post('/account/login', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();
		$login_status = 'invalid';
		$login_msg = 'Something went wrong...';

		$username 		= Request::input('username');
		$password 		= Request::input('password');
		$remember 		= Request::input('remember');

		$credentials 	= ['login' => $username, 'password' => $password];
		$user = Sentinel::findByCredentials($credentials);

		if ($user == null) {

			$login_msg = 'User not found!';

		} else {

			$actex = Activation::exists($user);
			$actco = Activation::completed($user);
			$active = false;
			if($actex) {
				$active = false;
			} elseif($actco) {
				$active = true;
			}

			if ($active === false) {

				$login_msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

			} elseif ($active === true) {

				if(Sentinel::authenticate($credentials)) {

					$login = Sentinel::login($user, $remember);
					if(!$login) {
						$login_msg = 'Could not log you in. Please try again.';
					} else {
						$login_status = 'success';
						$resp['redirect_url'] = URL::route('account');
					}

				} else {
					$login_msg = 'Username or password was wrong. Please try again.';
				}

			} 

		}

		$resp['login_status'] = $login_status;
		$resp['login_msg'] = $login_msg;

		return Response::json($resp);
	});
	Route::post('/account/forgot/password', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();
		$forgot_status = 'invalid';
		$forgot_msg = 'Something went wrong...';

		$username = Request::input('username');

		$credentials 	= ['login' => $username];

		$user = Sentinel::findByCredentials($credentials);

		if ($user == null) {

			$forgot_msg = 'User not found!';

		} else {

			$actex = Activation::exists($user);
			$actco = Activation::completed($user);
			$active = false;
			if($actex) {
				$active = false;
			} elseif($actco) {
				$active = true;
			}

			$remex = Reminder::exists($user);
			$reminder = false;
			if($remex) {
				$reminder = true;
			}

			if ($active == false) {

				$forgot_msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

			} elseif ($reminder == true) {

				$forgot_msg = '<strong>You have already asked for a reminder!</strong><br>Please check your inbox for the reminder email.';

			} elseif ($active == true && $reminder == false) {

				$reminder 		= Reminder::create($user);
				$reminder_code 	= $reminder->code;

				Mail::send('emails.auth.forgot-password', 
					array(
						'link' => URL::route('account-recover', $reminder_code),
						'firstname' => $user->firstname,
						'username' => $user->username,
					), function($message) use ($user) {
						$message->to($user->email, $user->firstname)->subject('Forgot Password');
				});
				
				if(count(Mail::failures()) > 0) {
					$forgot_msg = 'Mail Failure.';
				} else {
					$forgot_status = 'success';
					$forgot_msg = 'Everything went well.';
				}

				if(!$reminder) {
					$forgot_msg = 'E-mail or birthdate was wrong. Please try again.';
				}
			}

		}

		$resp['forgot_status'] 	= $forgot_status;
		$resp['forgot_msg'] 	= $forgot_msg;

		return Response::json($resp);
	});
	Route::post('/account/resetpassword', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp 				= array();
		$resetpw_status 	= 'invalid';
		$resetpw_msg 		= 'Something went wrong...';

		$username 			= Request::input('username');
		$password 			= Request::input('password');
		$resetpassword_code	= Request::input('resetpassword_code');
		$credentials 		= ['login' => $username];
		$user 				= Sentinel::findByCredentials($credentials);

		if (Reminder::complete($user, $resetpassword_code, $password)) {
			$resetpw_status 		= 'success';
			$resp['redirect_url'] 	= URL::route('account-login');
		} else {
			$resetpw_msg 	= 'Something went wrong while reseting your password. Please try again later.';
		}

		$resp['resetpw_status'] 	= $resetpw_status;
		$resp['resetpw_msg'] 		= $resetpw_msg;

		return Response::json($resp);
		
	});
});