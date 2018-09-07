<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| DEBUG ONLY
*/
if(Config::get('app.debug')) {
	Route::get('/resetdb', function() {
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		Artisan::call('db:seed');
		return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
	});
	Route::get('/test', function() {
		App::abort(500);
	});
}

Route::group([
	'middleware' => 'setTheme:vobilet'
	], function() {
		Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
		Route::get('/r/{code}', ['middleware' => 'sentinel.guest', 'as' => 'account-referral', 'uses' => 'Member\ReferralController@store']);
		Route::group([
			'prefix' => 'news'
			], function() {
				Route::get('/', [
					'as' => 'news',
					'uses' => 'News\NewsController@index'
				]);
				Route::get('/{slug}', [
					'as' => 'news-show',
					'uses' => 'News\NewsController@show'
				]);
				Route::get('/category/{slug}', [
					'as' => 'news-category-show',
					'uses' => 'News\NewsCategoryController@show'
				]);
		});
		Route::group([
			'prefix' => 'crew'
			], function() {
				Route::get('/', [
					'as' => 'crew',
					'uses' => 'Crew\CrewController@index'
				]);
		});
});

Route::group([
	'middleware' => ['sentinel.guest', 'setTheme:vobilet'],
	'prefix' => 'account',
	], function() {
		Route::get('/password/forgot', [
			'as' => 'account-forgot-password' ,
			'uses' => 'Member\RecoverController@getForgotPassword'
		]);
		Route::post('/password/forgot', [
			'as' => 'account-forgot-password-post' ,
			'uses' => 'Member\RecoverController@postForgotPassword'
		]);
		Route::get('/password/reset/{code}', [
			'as' => 'account-reset-password' ,
			'uses' => 'Member\RecoverController@getResetPassword'
		]);
		Route::post('/password/reset/{code}', [
			'as' => 'account-reset-password-post' ,
			'uses' => 'Member\RecoverController@postResetPassword'
		]);
		Route::get('/signup', [
			'as' => 'account-signup',
			'uses' => 'Member\AuthController@getSignUp'
		]);
		Route::post('/signup', [
			'as' => 'account-signup-post',
			'uses' => 'Member\AuthController@postSignUp'
		]);
		Route::get('/signin', [
			'as' => 'account-signin',
			'uses' => 'Member\AuthController@getSignIn'
		]);
		Route::post('/signin', [
			'as' => 'account-signin-post',
			'uses' => 'Member\AuthController@postSignIn'
		]);
		Route::get('/activate/{activation_code}', [
			'as' => 'account-activate',
			'uses' => 'Member\AuthController@getActivate'
		]);
		Route::post('/activate/{activation_code}', [
			'as' => 'account-activate-post',
			'uses' => 'Member\AuthController@postActivate'
		]);
		Route::get('/resendverification', [
			'as' => 'account-resendverification' ,
			'uses' => 'Member\RecoverController@getResendVerification'
		]);
		Route::post('/resendverification', [
			'as' => 'account-resendverification-post' ,
			'uses' => 'Member\RecoverController@postResendVerification'
		]);
		
});

Route::group([
	'middleware' => ['sentinel.auth', 'setTheme:neon-user'],
	'prefix' => 'user',
	], function() {
		Route::get('/', [
			'as' => 'dashboard' ,
			'uses' => 'Member\AccountController@getDashboard'
		]);
		Route::get('/logout', [
			'as' => 'logout',
			'uses' => 'Member\AuthController@getLogout'
		]);
		Route::get('/profile/{username}', [
			'as' => 'user-profile',
			'uses' => 'Member\MemberController@profile'
		]);
		Route::get('/members', [
			'as' => 'members',
			'uses' => 'Member\MemberController@index'
		]);
		Route::post('/members/search', [
			'as' => 'members-search',
			'uses' => 'Member\MemberController@search'
		]);
		Route::get('/crew', [
			'as' => 'user-crew',
			'uses' => 'Crew\CrewController@index'
		]);
		Route::group([
			'prefix' => 'seating'
			], function() {
				Route::get('/', [
					'as' => 'seating',
					'uses' => 'Seating\ReserveSeatingController@index'
				]);
				Route::get('/{id}/pay', [
					'as' => 'seating-pay',
					'uses' => 'Seating\PaymentSeatingController@pay'
				]);
				Route::post('/{slug}/charge', [
					'as' => 'seating-charge',
					'uses' => 'Seating\PaymentSeatingController@charge'
				]);
				Route::get('/{id}/paylater', [
					'as' => 'seating-paylater',
					'uses' => 'Seating\PaymentSeatingController@paylater'
				]);
				Route::get('/{id}/changepayment', [
					'as' => 'seating-changepayment',
					'uses' => 'Seating\PaymentSeatingController@changepayment'
				]);
				Route::get('/{id}/removereservation', [
					'as' => 'seating-removereservation',
					'uses' => 'Seating\ReserveSeatingController@destroy'
				]);
				Route::get('/consentform', [
					'as' => 'seating-consentform',
					'uses' => 'Seating\ReserveSeatingController@consentform'
				]);
				Route::get('/{slug}', [
					'as' => 'seating-show',
					'uses' => 'Seating\ReserveSeatingController@show'
				]);
				Route::post('/{slug}/reserve', [
					'as' => 'seating-reserve',
					'uses' => 'Seating\ReserveSeatingController@reserve'
				]);
				Route::get('/{slug}/ticket/download', [
					'as' => 'seating-ticket-download',
					'uses' => 'Seating\ReserveSeatingController@ticketdownload'
				]);	
		});
		Route::group([
			'prefix' => 'account'
			], function() {
				Route::get('/', [
					'as' => 'account' ,
					'uses' => 'Member\AccountController@getAccount'
				]);
				Route::get('/settings', [
					'as' => 'account-settings' ,
					'uses' => 'Member\AccountController@getSettings'
				]);
				Route::post('/settings', [
					'as' => 'account-settings-post' ,
					'uses' => 'Member\AccountController@postSettings'
				]);
				Route::get('/change/password', [
					'as' => 'account-change-password' ,
					'uses' => 'Member\AccountController@getChangePassword'
				]);
				Route::post('/change/password', [
					'as' => 'account-change-password-post' ,
					'uses' => 'Member\AccountController@postChangePassword'
				]);
				Route::get('/change/details', [
					'as' => 'account-change-details' ,
					'uses' => 'Member\AccountController@getChangeDetails'
				]);
				Route::post('/change/details', [
					'as' => 'account-change-details-post' ,
					'uses' => 'Member\AccountController@postChangeDetails'
				]);
				Route::get('/change/images', [
					'as' => 'account-change-images' ,
					'uses' => 'Member\AccountController@getChangeImages'
				]);
				Route::post('/change/images/profile', [
					'as' => 'account-change-image-profile-post' ,
					'uses' => 'Member\AccountController@postChangeProfileImage'
				]);
				Route::post('/change/images/cover', [
					'as' => 'account-change-image-cover-post' ,
					'uses' => 'Member\AccountController@postChangeProfileCover'
				]);
				Route::group([
					'prefix' => 'billing'
					], function() {
						Route::get('/payments', [
							'as' => 'account-billing-payments' ,
							'uses' => 'Member\BillingController@getPayments'
						]);
						Route::get('/payment/{id}', [
							'as' => 'account-billing-payment' ,
							'uses' => 'Member\BillingController@getPayment'
						]);
						Route::get('/receipt/{id}', [
							'as' => 'account-billing-receipt' ,
							'uses' => 'Member\BillingController@getReceipt'
						]);
						Route::get('/charges', [
							'as' => 'account-billing-charges' ,
							'uses' => 'Member\BillingController@getCharges'
						]);
				});
				Route::group([
					'prefix' => 'reservation'
					], function() {
						Route::get('/', [
							'as' => 'account-reservation' ,
							'uses' => 'Member\ReservationController@index'
						]);
						Route::get('/{id}', [
							'as' => 'account-reservation-view' ,
							'uses' => 'Member\ReservationController@view'
						]);
				});
				Route::group([
					'prefix' => 'addressbook'
					], function() {
						Route::get('/', [
							'as' => 'account-addressbook',
							'uses' => 'Member\AddressBookController@index'
						]);
						Route::get('/create', [
							'as' => 'account-addressbook-create',
							'uses' => 'Member\AddressBookController@create'
						]);
						Route::post('/store', [
							'as' => 'account-addressbook-store',
							'uses' => 'Member\AddressBookController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'account-addressbook-edit',
							'uses' => 'Member\AddressBookController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'account-addressbook-update',
							'uses' => 'Member\AddressBookController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'account-addressbook-destroy',
							'uses' => 'Member\AddressBookController@destroy'
						]);
				});
		});
});

// ADMIN PANEL
Route::group([
	'middleware' => ['sentinel.auth', 'sentinel.admin', 'setTheme:neon-admin'],
	'prefix' => 'admin',
	], function() {
		Route::get('/', [
			'as' => 'admin' ,
			'uses' => 'Admin\AdminController@dashboard'
		]);
		Route::group([
			'prefix' => 'crew'
			], function() {
				Route::get('/', [
					'as' => 'admin-crew',
					'uses' => 'Crew\CrewController@admin'
				]);
				Route::get('/create', [
					'as' => 'admin-crew-create',
					'uses' => 'Crew\CrewController@create'
				]);
				Route::post('/store', [
					'as' => 'admin-crew-store',
					'uses' => 'Crew\CrewController@store'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-crew-edit',
					'uses' => 'Crew\CrewController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-crew-update',
					'uses' => 'Crew\CrewController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-crew-destroy',
					'uses' => 'Crew\CrewController@destroy'
				]);
				Route::group([
					'prefix' => 'categories'
					], function() {
						Route::get('/', [
							'as' => 'admin-crew-category',
							'uses' => 'Crew\CrewCategoryController@admin'
						]);
						Route::get('/create', [
							'as' => 'admin-crew-category-create',
							'uses' => 'Crew\CrewCategoryController@create'
						]);
						Route::post('/store', [
							'as' => 'admin-crew-category-store',
							'uses' => 'Crew\CrewCategoryController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-crew-category-edit',
							'uses' => 'Crew\CrewCategoryController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-crew-category-update',
							'uses' => 'Crew\CrewCategoryController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-crew-category-destroy',
							'uses' => 'Crew\CrewCategoryController@destroy'
						]);
				});
				Route::group([
					'prefix' => 'skill'
					], function() {
						Route::get('/', [
							'as' => 'admin-crew-skill',
							'uses' => 'Crew\CrewSkillController@admin'
						]);
						Route::get('/create', [
							'as' => 'admin-crew-skill-create',
							'uses' => 'Crew\CrewSkillController@create'
						]);
						Route::post('/store', [
							'as' => 'admin-crew-skill-store',
							'uses' => 'Crew\CrewSkillController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-crew-skill-edit',
							'uses' => 'Crew\CrewSkillController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-crew-skill-update',
							'uses' => 'Crew\CrewSkillController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-crew-skill-destroy',
							'uses' => 'Crew\CrewSkillController@destroy'
						]);
						Route::group([
							'prefix' => 'attachment'
							], function() {
								Route::get('/', [
									'as' => 'admin-crew-skill-attachment',
									'uses' => 'Crew\CrewSkillAttachmentController@admin'
								]);
								Route::get('/create', [
									'as' => 'admin-crew-skill-attachment-create',
									'uses' => 'Crew\CrewSkillAttachmentController@create'
								]);
								Route::post('/store', [
									'as' => 'admin-crew-skill-attachment-store',
									'uses' => 'Crew\CrewSkillAttachmentController@store'
								]);
								Route::get('/{id}/edit', [
									'as' => 'admin-crew-skill-attachment-edit',
									'uses' => 'Crew\CrewSkillAttachmentController@edit'
								]);
								Route::post('/{id}/update', [
									'as' => 'admin-crew-skill-attachment-update',
									'uses' => 'Crew\CrewSkillAttachmentController@update'
								]);
								Route::get('/{id}/destroy', [
									'as' => 'admin-crew-skill-attachment-destroy',
									'uses' => 'Crew\CrewSkillAttachmentController@destroy'
								]);
						});
				});
		});
		Route::group([
			'prefix' => 'news'
			], function() {
				Route::get('/', [
					'as' => 'admin-news',
					'uses' => 'News\NewsController@admin'
				]);
				Route::get('/create', [
					'as' => 'admin-news-create',
					'uses' => 'News\NewsController@create'
				]);
				Route::post('/store', [
					'as' => 'admin-news-store',
					'uses' => 'News\NewsController@store'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-news-edit',
					'uses' => 'News\NewsController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-news-update',
					'uses' => 'News\NewsController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-news-destroy',
					'uses' => 'News\NewsController@destroy'
				]);
				Route::group([
					'prefix' => 'categories'
					], function() {
						Route::get('/', [
							'as' => 'admin-news-category',
							'uses' => 'News\NewsCategoryController@admin'
						]);
						Route::get('/create', [
							'as' => 'admin-news-category-create',
							'uses' => 'News\NewsCategoryController@create'
						]);
						Route::post('/store', [
							'as' => 'admin-news-category-store',
							'uses' => 'News\NewsCategoryController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-news-category-edit',
							'uses' => 'News\NewsCategoryController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-news-category-update',
							'uses' => 'News\NewsCategoryController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-news-category-destroy',
							'uses' => 'News\NewsCategoryController@destroy'
						]);
				});
		});
		Route::group([
			'prefix' => 'seating'
			], function() {
				Route::group([
					'prefix' => 'rows'
					], function() {
						Route::get('/', [
							'as' => 'admin-seating-rows',
							'uses' => 'Admin\Seating\RowsController@index'
						]);
						Route::get('/create', [
							'as' => 'admin-seating-row-create',
							'uses' => 'Admin\Seating\RowsController@create'
						]);
						Route::post('/store', [
							'as' => 'admin-seating-row-store',
							'uses' => 'Admin\Seating\RowsController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-seating-row-edit',
							'uses' => 'Admin\Seating\RowsController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-seating-row-update',
							'uses' => 'Admin\Seating\RowsController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-seating-row-destroy',
							'uses' => 'Admin\Seating\RowsController@destroy'
						]);
				});
				Route::group([
					'prefix' => 'seats'
					], function() {
						Route::get('/', [
							'as' => 'admin-seating-seats',
							'uses' => 'Admin\Seating\SeatsController@index'
						]);
						Route::get('/create', [
							'as' => 'admin-seating-seat-create',
							'uses' => 'Admin\Seating\SeatsController@create'
						]);
						Route::post('/store', [
							'as' => 'admin-seating-seat-store',
							'uses' => 'Admin\Seating\SeatsController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-seating-seat-edit',
							'uses' => 'Admin\Seating\SeatsController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-seating-seat-update',
							'uses' => 'Admin\Seating\SeatsController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-seating-seat-destroy',
							'uses' => 'Admin\Seating\SeatsController@destroy'
						]);
				});
				Route::group([
					'prefix' => 'reservation'
					], function() {
						Route::get('/', [
							'as' => 'admin-seating-reservations',
							'uses' => 'Admin\ReservationController@index'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-seating-reservation-edit',
							'uses' => 'Admin\ReservationController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-seating-reservation-update',
							'uses' => 'Admin\ReservationController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-seating-reservation-destroy',
							'uses' => 'Admin\ReservationController@destroy'
						]);
						Route::group([
							'prefix' => 'brokenband'
							], function() {
								Route::get('/', [
									'as' => 'admin-seating-brokenband',
									'uses' => 'Admin\BrokenBandController@index'
								]);
								Route::post('/check', [
									'as' => 'admin-seating-brokenband-check',
									'uses' => 'Admin\BrokenBandController@check'
								]);
								Route::get('/show/{id}', [
									'as' => 'admin-seating-brokenband-show',
									'uses' => 'Admin\BrokenBandController@show'
								]);
								Route::post('/store/{id}', [
									'as' => 'admin-seating-brokenband-store',
									'uses' => 'Admin\BrokenBandController@store'
								]);
						});
						Route::get('/{slug}', [
							'as' => 'admin-seating-reservation-show',
							'uses' => 'Admin\ReservationController@show'
						]);
						Route::post('/{slug}/reserve', [
							'as' => 'admin-seating-reservation-reserve',
							'uses' => 'Admin\ReservationController@reserve'
						]);
						Route::get('/{slug}/pdf', [
							'as' => 'admin-seating-reservation-pdf',
							'uses' => 'Admin\ReservationController@showPDF'
						]);
						Route::get('/{slug}/paylater', [
							'as' => 'admin-seating-reservation-paylater',
							'uses' => 'Admin\ReservationController@paylater'
						]);
						
				});
				Route::group([
					'prefix' => 'checkin'
					], function() {
						Route::group([
							'prefix' => 'visitor'
							], function() {
								Route::get('/', [
									'as' => 'admin-seating-checkin-visitor',
									'uses' => 'Admin\VisitorController@index'
								]);
								Route::post('/store', [
									'as' => 'admin-seating-checkin-visitor-store',
									'uses' => 'Admin\VisitorController@store'
								]);
						});
						Route::get('/', [
							'as' => 'admin-seating-checkin',
							'uses' => 'Admin\CheckinController@index'
						]);
						Route::get('/{id}', [
							'as' => 'admin-seating-checkin-show',
							'uses' => 'Admin\CheckinController@show'
						]);
						Route::post('/check', [
							'as' => 'admin-seating-checkin-check',
							'uses' => 'Admin\CheckinController@check'
						]);
						Route::post('/store/{id}', [
							'as' => 'admin-seating-checkin-store',
							'uses' => 'Admin\CheckinController@store'
						]);
				});
				Route::group([
					'prefix' => 'print'
					], function() {
						Route::get('/', [
							'as' => 'admin-seating-print',
							'uses' => 'Admin\PrintSeatController@index'
						]);
						Route::get('/seat/{slug}', [
							'as' => 'admin-seating-print-seat',
							'uses' => 'Admin\PrintSeatController@printSeat'
						]);
				});
		});
		Route::group([
			'prefix' => 'pages'
			], function() {
				Route::get('/', [
					'as' => 'admin-pages',
					'uses' => 'Page\PagesController@admin'
				]);
				Route::get('/create', [
					'as' => 'admin-pages-create',
					'uses' => 'Page\PagesController@create'
				]);
				Route::post('/store', [
					'as' => 'admin-pages-store',
					'uses' => 'Page\PagesController@store'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-pages-edit',
					'uses' => 'Page\PagesController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-pages-update',
					'uses' => 'Page\PagesController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-pages-destroy',
					'uses' => 'Page\PagesController@destroy'
				]);
		});
		Route::group([
			'prefix' => 'users'
			], function() {
				Route::get('/', [
					'as' => 'admin-users',
					'uses' => 'Admin\UserController@index'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-user-edit',
					'uses' => 'Admin\UserController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-user-update',
					'uses' => 'Admin\UserController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-user-destroy',
					'uses' => 'Admin\UserController@destroy'
				]);
				Route::get('/{id}/restore', [
					'as' => 'admin-user-restore',
					'uses' => 'Admin\UserController@restore'
				]);
		});
		Route::group([
			'prefix' => 'info'
			], function() {
				Route::get('/', [
					'as' => 'admin-info',
					'uses' => 'Admin\InfoController@index'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-info-edit',
					'uses' => 'Admin\InfoController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-info-update',
					'uses' => 'Admin\InfoController@update'
				]);
		});
		Route::group([
			'prefix' => 'sponsor'
			], function() {
				Route::get('/', [
					'as' => 'admin-sponsor',
					'uses' => 'Admin\SponsorController@index'
				]);
				Route::get('/create', [
					'as' => 'admin-sponsor-create',
					'uses' => 'Admin\SponsorController@create'
				]);
				Route::post('/store', [
					'as' => 'admin-sponsor-store',
					'uses' => 'Admin\SponsorController@store'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-sponsor-edit',
					'uses' => 'Admin\SponsorController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-sponsor-update',
					'uses' => 'Admin\SponsorController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-sponsor-destroy',
					'uses' => 'Admin\SponsorController@destroy'
				]);
		});
		Route::group([
			'prefix' => 'system'
			], function() {
				Route::get('logs', [
					'as' => 'admin-logs',
					'uses' => 'Admin\LogController@index'
				]);
				Route::get('/activitylog', [
					'as' => 'admin-activity' ,
					'uses' => 'Admin\AdminController@activity'
				]);
				Route::get('/whatsnew', [
					'as' => 'admin-whatsnew' ,
					'uses' => 'Admin\AdminController@whatsnew'
				]);
				Route::group([
					'prefix' => 'license'
					], function() {
						Route::get('/', [
							'as' => 'admin-license',
							'uses' => 'Admin\LicenseController@index'
						]);
						Route::get('/check', [
							'as' => 'admin-license-check',
							'uses' => 'Admin\LicenseController@check'
						]);
						Route::post('/store', [
							'as' => 'admin-license-store',
							'uses' => 'Admin\LicenseController@store'
						]);
				});
				Route::group([
					'prefix' => 'settings'
					], function() {
						Route::get('/', [
							'as' => 'admin-settings',
							'uses' => 'Admin\SettingsController@index'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-settings-edit',
							'uses' => 'Admin\SettingsController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-settings-update',
							'uses' => 'Admin\SettingsController@update'
						]);
				});
		});

});

Route::group(['prefix' => 'ajax',], function() {
	Route::get('/usernames', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$users = User::all();
		$usernames = array();
		foreach($users as $user) {
			if($user->showname) {
				array_push($usernames, array('id' => $user->id, 'name' => $user->firstname.' "' .$user->username. '" '.$user->lastname));
			} else {
				array_push($usernames, array('id' => $user->id, 'name' => $user->firstname.' "' .$user->username. '"'));
			}
		}
		return Response::json($usernames);
	});
	Route::get('/rows', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$allrows = SeatRows::all();
		$rows = array();
		foreach($allrows as $row) {
			array_push($rows, array('id' => $row->id, 'name' => $row->name));
		}
		return Response::json($rows);
	});
	Route::get('/seats', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$allseats = Seats::all();
		$seats = array();
		foreach($allseats as $seat) {
			array_push($seats, array('id' => $seat->id, 'name' => $seat->name));
		}
		return Response::json($seats);
	});
	Route::get('/crew/categories', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$allcc = CrewCategory::all();
		$ccs = array();
		foreach($allcc as $cc) {
			array_push($ccs, array('id' => $cc->id, 'title' => $cc->title));
		}
		return Response::json($ccs);
	});
	Route::get('/crew/skills', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$allcs = CrewSkill::all();
		$css = array();
		foreach($allcs as $cs) {
			array_push($css, array('id' => $cs->id, 'title' => $cs->title));
		}
		return Response::json($css);
	});
	Route::get('/pages', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$allpages = Page::where('active', '=', 1)->where('showinmenu', '=', 1)->get();
		$pages = array();
		foreach($allpages as $page) {
			array_push($pages, array('slug' => $page->slug, 'title' => $page->title));
		}
		return Response::json($pages);
	});
	
});

// THIS NEEDS TO BE AT THE BOTTOM TO MAKE ALL OTHER ROUTES WORK
Route::get('/{slug}', ['middleware' => 'setTheme:vobilet', 'as' => 'page', 'uses' => 'Page\PagesController@show']);