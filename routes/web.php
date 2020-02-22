<?php

use LANMS\Notifications\SeatReservationExpires;
use LANMS\SeatReservation;

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
if (Config::get('app.debug')) {
    Route::get('/resetdb', function () {
        \Session::forget('laravel_session');
        Artisan::call('migrate:reset');
        Artisan::call('lanms:update');
        Artisan::call('db:seed');
        return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
    });
    Route::get('/test/notification', function () {
        /*$user = Sentinel::getUser();
        if ($user->stripecustomer) {
            $stripe_customer_code = $user->stripecustomer->cus;
            $invoices = \Stripe::invoices()->all(array('customer' => $stripe_customer_code, 'limit' => 100));
            $invoices = $invoices['data'];
            foreach ($invoices as $invoice) {
                $data = [
                    'amount_due' => $invoice['amount_due'],
                    'due_date' => $invoice['due_date'],
                    'currency' => $invoice['currency'],
                    'url' => route('account-billing-invoice-view', $invoice['id']),
                ];
                $db_data = collect($data)->toJson();
                // Check if there is a notification already
                $notification = DB::table('notifications')->where('data', $db_data)->where('read_at', null)->first();
                if (!$notification) {
                    Notification::send($user, new LANMS\Notifications\InvoiceUnPaid($invoice));
                }
            }
        }*/
        $reservation = SeatReservation::all()->first();
        if ($reservation) {
            $reservation->reservedby->notify(new SeatReservationExpires($reservation));
            dd('Reminder sent to '.$reservation->reservedby->username.' for seat '.$reservation->seat->name.' in reservation '.$reservation->id.'.');
        }
    });
    Route::get('/test', function () {
        App::abort(404);
    });
    Route::get('/pdf', function () {
        \Theme::set('vobilet');
        return view('seating.pdf.consentform');
    });
}

Route::group([
    'middleware' => 'setTheme:vobilet'
    ], function () {
        Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
        Route::get('/schedule', ['as' => 'schedule', 'uses' => 'HomeController@schedule']);
        Route::get('/tickets', ['as' => 'tickets', 'uses' => 'HomeController@tickets']);
        Route::get('locale/{locale}', ['as' => 'locale', 'uses' => 'HomeController@locale']);
        Route::get('theme', ['as' => 'theme', 'uses' => 'HomeController@theme']);
        Route::get('/r/{code}', ['middleware' => 'sentinel.guest', 'as' => 'account-referral', 'uses' => 'Member\ReferralController@store']);
        Route::get('/consentform', ['as' => 'consentform', 'uses' => 'Seating\ReserveSeatingController@consentform']);
        Route::group([
            'prefix' => 'news'
            ], function () {
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
            ], function () {
                Route::get('/', [
                    'as' => 'crew',
                    'uses' => 'Crew\CrewController@index'
                ]);
            });
        Route::get('/sponsor', ['as' => 'sponsor', 'uses' => 'Admin\SponsorController@index']);
        Route::group([
            'prefix' => 'compo'
            ], function () {
                Route::get('/', [
                    'as' => 'compo',
                    'uses' => 'Compo\CompoController@index'
                ]);
                Route::get('/{slug}', [
                    'as' => 'compo-show',
                    'uses' => 'Compo\CompoController@show'
                ]);
            });
    });

Route::group([
    'middleware' => ['sentinel.guest', 'setTheme:vobilet'],
    'prefix' => 'account',
    ], function () {
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
    'middleware' => ['sentinel.auth', 'setTheme:vobilet', 'gdpr.terms'],
    'prefix' => 'account'
    ], function () {
        Route::get('/', [
            'as' => 'account' ,
            'uses' => 'Member\AccountController@getAccount'
        ]);
        Route::get('/change/password', [
            'as' => 'account-change-password' ,
            'uses' => 'Member\AccountController@getChangePassword'
        ]);
        Route::post('/change/password', [
            'as' => 'account-change-password-post' ,
            'uses' => 'Member\AccountController@postChangePassword'
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
        Route::get('/download', [
            'as' => 'account-gdpr-download' ,
            'uses' => 'Member\AccountController@getGDPRDownload'
        ]);
        Route::get('/delete', [
            'as' => 'account-gdpr-delete' ,
            'uses' => 'Member\AccountController@getGDPRDelete'
        ]);
        Route::post('/delete', [
            'as' => 'account-gdpr-delete-post' ,
            'uses' => 'Member\AccountController@postGDPRDelete'
        ]);
        Route::get('/verifyphone', [
            'as' => 'account-verifyphone',
            'uses' => 'Auth\PhoneVerificationController@startVerification'
        ]);
        Route::post('/verifycode', [
            'as' => 'account-verifycode',
            'uses' => 'Auth\PhoneVerificationController@verifyCode'
        ]);
        Route::group([
            'prefix' => 'billing'
            ], function () {
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
                Route::get('/invoice', [
                    'as' => 'account-billing-invoice' ,
                    'uses' => 'Billing\InvoiceController@index'
                ]);
                Route::get('/invoice/{id}', [
                    'as' => 'account-billing-invoice-view' ,
                    'uses' => 'Billing\InvoiceController@view'
                ]);
                Route::get('/invoice/{id}/pay', [
                    'as' => 'account-billing-invoice-pay' ,
                    'uses' => 'Billing\InvoiceController@pay'
                ]);
                Route::get('/invoice/{id}/charge', [
                    'as' => 'account-billing-invoice-charge' ,
                    'uses' => 'Billing\InvoiceController@charge'
                ]);
                Route::get('/card', [
                    'as' => 'account-billing-card' ,
                    'uses' => 'Billing\CardController@index'
                ]);
                Route::get('/card/create', [
                    'as' => 'account-billing-card-create' ,
                    'uses' => 'Billing\CardController@create'
                ]);
                Route::post('/card/store', [
                    'as' => 'account-billing-card-store' ,
                    'uses' => 'Billing\CardController@store'
                ]);
                Route::get('/card/{id}/destroy', [
                    'as' => 'account-billing-card-destroy' ,
                    'uses' => 'Billing\CardController@destroy'
                ]);
            });
        Route::group([
            'prefix' => 'reservation'
            ], function () {
                Route::get('/', [
                    'as' => 'account-reservation' ,
                    'uses' => 'Member\ReservationController@index'
                ]);
                Route::get('/{id}', [
                    'as' => 'account-reservation-view' ,
                    'uses' => 'Member\ReservationController@view'
                ]);
            });
    });
Route::group([
    'middleware' => ['sentinel.auth', 'setTheme:vobilet', 'gdpr.terms'],
    'prefix' => 'user',
    ], function () {
        Route::get('/logout', [
            'as' => 'logout',
            'uses' => 'Member\AuthController@getLogout'
        ]);
        Route::get('/profile/{username}', [
            'as' => 'user-profile',
            'uses' => 'Member\MemberController@profile'
        ]);
        Route::get('/profile/{username}/edit', [
            'as' => 'user-profile-edit',
            'uses' => 'Member\AccountController@getEditProfile'
        ]);
        Route::post('/profile/{username}/edit', [
            'as' => 'user-profile-edit-post',
            'uses' => 'Member\AccountController@postEditProfile'
        ]);
        Route::get('/notifications', [
            'as' => 'user-notifications',
            'uses' => 'NotificationController@show'
        ]);
        Route::get('/notifications/dismissall', [
            'as' => 'user-notifications-dismissall',
            'uses' => 'NotificationController@dismissall'
        ]);
        Route::get('/notification/{id}/dismiss', [
            'as' => 'user-notification-dismiss',
            'uses' => 'NotificationController@dismiss'
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
            'prefix' => 'compo'
            ], function () {
                Route::group([
                    'prefix' => 'team'
                    ], function () {
                        Route::get('/', [
                            'as' => 'compo-team',
                            'uses' => 'Compo\CompoTeamController@index'
                        ]);
                        Route::get('/create', [
                            'as' => 'compo-team-create',
                            'uses' => 'Compo\CompoTeamController@create'
                        ]);
                        Route::post('/store', [
                            'as' => 'compo-team-store',
                            'uses' => 'Compo\CompoTeamController@store'
                        ]);
                        Route::get('/{id}/edit', [
                            'as' => 'compo-team-edit',
                            'uses' => 'Compo\CompoTeamController@edit'
                        ]);
                        Route::post('/{id}/update', [
                            'as' => 'compo-team-update',
                            'uses' => 'Compo\CompoTeamController@update'
                        ]);
                        Route::get('/{id}/destroy', [
                            'as' => 'compo-team-destroy',
                            'uses' => 'Compo\CompoTeamController@destroy'
                        ]);
                    });
                Route::get('/{slug}/signup', [
                    'as' => 'compo-signup',
                    'uses' => 'Compo\CompoSignUpController@create'
                ]);
                Route::post('/{slug}/signup/store', [
                    'as' => 'compo-signup-store',
                    'uses' => 'Compo\CompoSignUpController@store'
                ]);
                Route::get('/{slug}/signup/destroy', [
                    'as' => 'compo-signup-destroy',
                    'uses' => 'Compo\CompoSignUpController@destroy'
                ]);
            });
        Route::group([
            'prefix' => 'seating'
            ], function () {
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
                Route::get('/{slug}/show', [
                    'as' => 'seating-show',
                    'uses' => 'Seating\ReserveSeatingController@show'
                ]);
                Route::post('/{slug}/reserve', [
                    'as' => 'seating-reserve',
                    'uses' => 'Seating\ReserveSeatingController@reserve'
                ]);
                Route::get('/{slug}/ticket/show', [
                    'as' => 'seating-ticket-show',
                    'uses' => 'Seating\ReserveSeatingController@ticketshow'
                ]);
                Route::get('/{slug}/ticket/download', [
                    'as' => 'seating-ticket-download',
                    'uses' => 'Seating\ReserveSeatingController@ticketdownload'
                ]);
            Route::group([
            'prefix' => 'checkin'
            ], function () {
                Route::get('/', [
                    'as' => 'seating-checkin',
                    'uses' => 'Seating\SelfCheckinController@index'
                ]);
                Route::get('/{id}', [
                    'as' => 'seating-checkin-show',
                    'uses' => 'Seating\SelfCheckinController@show'
                ]);
            });
        });
    });

// ADMIN PANEL
Route::group([
    'middleware' => ['sentinel.auth', 'sentinel.admin', 'setTheme:vobilet-admin', 'gdpr.terms'],
    'prefix' => 'admin',
    ], function () {
        Route::get('/', [
            'as' => 'admin' ,
            'uses' => 'Admin\AdminController@dashboard'
        ]);
        Route::group([
            'prefix' => 'crew'
            ], function () {
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
                    ], function () {
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
                    ], function () {
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
                            ], function () {
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
            ], function () {
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
                    ], function () {
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
            ], function () {
                Route::group([
                    'prefix' => 'rows'
                    ], function () {
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
                        Route::get('/{id}/restore', [
                            'as' => 'admin-seating-row-restore',
                            'uses' => 'Admin\Seating\RowsController@restore'
                        ]);
                    });
                Route::group([
                    'prefix' => 'tickettype'
                    ], function () {
                        Route::get('/', [
                            'as' => 'admin-seating-tickettypes',
                            'uses' => 'Admin\Seating\TicketTypeController@index'
                        ]);
                        Route::get('/create', [
                            'as' => 'admin-seating-tickettype-create',
                            'uses' => 'Admin\Seating\TicketTypeController@create'
                        ]);
                        Route::post('/store', [
                            'as' => 'admin-seating-tickettype-store',
                            'uses' => 'Admin\Seating\TicketTypeController@store'
                        ]);
                        Route::get('/{id}/edit', [
                            'as' => 'admin-seating-tickettype-edit',
                            'uses' => 'Admin\Seating\TicketTypeController@edit'
                        ]);
                        Route::post('/{id}/update', [
                            'as' => 'admin-seating-tickettype-update',
                            'uses' => 'Admin\Seating\TicketTypeController@update'
                        ]);
                        Route::get('/{id}/destroy', [
                            'as' => 'admin-seating-tickettype-destroy',
                            'uses' => 'Admin\Seating\TicketTypeController@destroy'
                        ]);
                        Route::get('/{id}/restore', [
                            'as' => 'admin-seating-tickettype-restore',
                            'uses' => 'Admin\Seating\TicketTypeController@restore'
                        ]);
                    });
                Route::group([
                    'prefix' => 'seats'
                    ], function () {
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
                        Route::get('/{id}/restore', [
                            'as' => 'admin-seating-seat-restore',
                            'uses' => 'Admin\Seating\SeatsController@restore'
                        ]);
                    });
                Route::group([
                    'prefix' => 'reservation'
                    ], function () {
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
                            ], function () {
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
                    ], function () {
                        Route::group([
                            'prefix' => 'visitor'
                            ], function () {
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
                    ], function () {
                        Route::get('/', [
                            'as' => 'admin-seating-print',
                            'uses' => 'Admin\PrintSeatController@index'
                        ]);
                        Route::get('/seat/{slug}', [
                            'as' => 'admin-seating-print-seat',
                            'uses' => 'Admin\PrintSeatController@printSeat'
                        ]);
                    });
                Route::group([
                    'prefix' => 'styling'
                    ], function () {
                        Route::get('/', [
                            'as' => 'admin-seating-styling',
                            'uses' => 'Admin\Seating\StylingController@index'
                        ]);
                        Route::get('/create', [
                            'as' => 'admin-seating-styling-create',
                            'uses' => 'Admin\Seating\StylingController@create'
                        ]);
                        Route::post('/store', [
                            'as' => 'admin-seating-styling-store',
                            'uses' => 'Admin\Seating\StylingController@store'
                        ]);
                        Route::get('/{id}/edit', [
                            'as' => 'admin-seating-styling-edit',
                            'uses' => 'Admin\Seating\StylingController@edit'
                        ]);
                        Route::post('/{id}/update', [
                            'as' => 'admin-seating-styling-update',
                            'uses' => 'Admin\Seating\StylingController@update'
                        ]);
                        Route::get('/{id}/destroy', [
                            'as' => 'admin-seating-styling-destroy',
                            'uses' => 'Admin\Seating\StylingController@destroy'
                        ]);
                    });
            });
        Route::group([
            'prefix' => 'compo'
            ], function () {
                Route::get('/', [
                    'as' => 'admin-compo',
                    'uses' => 'Compo\CompoController@admin'
                ]);
                Route::get('/create', [
                    'as' => 'admin-compo-create',
                    'uses' => 'Compo\CompoController@create'
                ]);
                Route::post('/store', [
                    'as' => 'admin-compo-store',
                    'uses' => 'Compo\CompoController@store'
                ]);
                Route::get('/{id}/edit', [
                    'as' => 'admin-compo-edit',
                    'uses' => 'Compo\CompoController@edit'
                ]);
                Route::post('/{id}/update', [
                    'as' => 'admin-compo-update',
                    'uses' => 'Compo\CompoController@update'
                ]);
                Route::get('/{id}/destroy', [
                    'as' => 'admin-compo-destroy',
                    'uses' => 'Compo\CompoController@destroy'
                ]);
            });
        Route::group([
            'prefix' => 'pages'
            ], function () {
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
                Route::get('/{id}/restore', [
                    'as' => 'admin-pages-restore',
                    'uses' => 'Page\PagesController@restore'
                ]);
            });
        Route::group([
            'prefix' => 'users'
            ], function () {
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
                Route::post('/{id}/update/permission', [
                    'as' => 'admin-user-update-permission',
                    'uses' => 'Admin\UserController@updatePermission'
                ]);
                Route::get('/{id}/resendverification', [
                    'as' => 'admin-user-resendverification',
                    'uses' => 'Admin\UserController@getResendVerification'
                ]);
                Route::get('/{id}/forgotpassword', [
                    'as' => 'admin-user-forgotpassword',
                    'uses' => 'Admin\UserController@getForgotPassword'
                ]);
                Route::get('/{id}/destroy', [
                    'as' => 'admin-user-destroy',
                    'uses' => 'Admin\UserController@destroy'
                ]);
                Route::get('/{id}/restore', [
                    'as' => 'admin-user-restore',
                    'uses' => 'Admin\UserController@restore'
                ]);
                Route::group([
                    'prefix' => 'roles'
                    ], function () {
                        Route::get('/', [
                            'as' => 'admin-roles',
                            'uses' => 'Admin\RoleController@index'
                        ]);
                        Route::get('/refreshpermissions', [
                            'as' => 'admin-roles-refreshpermissions',
                            'uses' => 'Admin\RoleController@refreshpermissions'
                        ]);
                        Route::get('/create', [
                            'as' => 'admin-role-create',
                            'uses' => 'Admin\RoleController@create'
                        ]);
                        Route::post('/store', [
                            'as' => 'admin-role-store',
                            'uses' => 'Admin\RoleController@store'
                        ]);
                        Route::get('/{id}/edit', [
                            'as' => 'admin-role-edit',
                            'uses' => 'Admin\RoleController@edit'
                        ]);
                        Route::post('/{id}/update', [
                            'as' => 'admin-role-update',
                            'uses' => 'Admin\RoleController@update'
                        ]);
                        Route::get('/{id}/destroy', [
                            'as' => 'admin-role-destroy',
                            'uses' => 'Admin\RoleController@destroy'
                        ]);
                    });
            });
        Route::group([
            'prefix' => 'billing'
            ], function () {
                Route::group([
                    'prefix' => 'invoice'
                    ], function () {
                        Route::get('/', [
                            'as' => 'admin-billing-invoice',
                            'uses' => 'Billing\InvoiceController@admin'
                        ]);
                        Route::get('/create', [
                            'as' => 'admin-billing-invoice-create',
                            'uses' => 'Billing\InvoiceController@create'
                        ]);
                        Route::post('/store', [
                            'as' => 'admin-billing-invoice-store',
                            'uses' => 'Billing\InvoiceController@store'
                        ]);
                        Route::get('/{id}', [
                            'as' => 'admin-billing-invoice-show',
                            'uses' => 'Billing\InvoiceController@show'
                        ]);
                        Route::get('/{id}/edit', [
                            'as' => 'admin-billing-invoice-edit',
                            'uses' => 'Billing\InvoiceController@edit'
                        ]);
                        Route::post('/{id}/update', [
                            'as' => 'admin-billing-invoice-update',
                            'uses' => 'Billing\InvoiceController@update'
                        ]);
                        Route::get('/{id}/destroy', [
                            'as' => 'admin-billing-invoice-destroy',
                            'uses' => 'Billing\InvoiceController@destroy'
                        ]);
                        Route::get('/{id}/finalize', [
                            'as' => 'admin-billing-invoice-finalize',
                            'uses' => 'Billing\InvoiceController@finalize'
                        ]);
                    });
            });
        Route::group([
            'prefix' => 'info'
            ], function () {
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
            ], function () {
                Route::get('/', [
                    'as' => 'admin-sponsor',
                    'uses' => 'Admin\SponsorController@admin'
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
                Route::get('/{id}/restore', [
                    'as' => 'admin-sponsor-restore',
                    'uses' => 'Admin\SponsorController@restore'
                ]);
                Route::get('/{id}/duplicate', [
                    'as' => 'admin-sponsor-duplicate',
                    'uses' => 'Admin\SponsorController@duplicate'
                ]);
            });
        Route::group([
            'prefix' => 'email'
            ], function () {
                Route::get('/', [
                    'as' => 'admin-emails',
                    'uses' => 'Admin\EmailController@index'
                ]);
                Route::get('/create', [
                    'as' => 'admin-emails-create',
                    'uses' => 'Admin\EmailController@create'
                ]);
                Route::post('/store', [
                    'as' => 'admin-emails-store',
                    'uses' => 'Admin\EmailController@store'
                ]);
                Route::get('/{id}', [
                    'as' => 'admin-emails-show',
                    'uses' => 'Admin\EmailController@show'
                ]);
            });
        Route::group([
            'prefix' => 'sms'
            ], function () {
                Route::get('/', [
                    'as' => 'admin-sms',
                    'uses' => 'Admin\SMSController@index'
                ]);
                Route::get('/create', [
                    'as' => 'admin-sms-create',
                    'uses' => 'Admin\SMSController@create'
                ]);
                Route::post('/store', [
                    'as' => 'admin-sms-store',
                    'uses' => 'Admin\SMSController@store'
                ]);
            });
        Route::group([
            'prefix' => 'system'
            ], function () {
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
                Route::get('/info', [
                    'as' => 'admin-systeminfo' ,
                    'uses' => 'Admin\AdminController@systeminfo'
                ]);
                Route::group([
                    'prefix' => 'license'
                    ], function () {
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
                    ], function () {
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

Route::group(['prefix' => 'ajax','middleware' => ['sentinel.auth', 'ajax.check']], function () {
    Route::get('/usernames', function () {
        $users = User::active();
        $usernames = array();
        foreach ($users as $user) {
            if ($user->showname) {
                array_push($usernames, array('id' => $user->id, 'name' => $user->firstname.' "' .$user->username. '" '.$user->lastname));
            } else {
                array_push($usernames, array('id' => $user->id, 'name' => $user->firstname.' "' .$user->username. '"'));
            }
        }
        return Response::json($usernames);
    });
    Route::get('/rows', function () {
        $allrows = SeatRows::all();
        $rows = array();
        foreach ($allrows as $row) {
            array_push($rows, array('id' => $row->id, 'name' => $row->name));
        }
        return Response::json($rows);
    });
    Route::get('/seats', function () {
        $allseats = Seats::all();
        $seats = array();
        foreach ($allseats as $seat) {
            array_push($seats, array('id' => $seat->id, 'name' => $seat->name));
        }
        return Response::json($seats);
    });
    Route::get('/crew/categories', function () {
        $allcc = CrewCategory::all();
        $ccs = array();
        foreach ($allcc as $cc) {
            array_push($ccs, array('id' => $cc->id, 'title' => $cc->title));
        }
        return Response::json($ccs);
    });
    Route::get('/crew/skills', function () {
        $allcs = CrewSkill::all();
        $css = array();
        foreach ($allcs as $cs) {
            array_push($css, array('id' => $cs->id, 'title' => $cs->title));
        }
        return Response::json($css);
    });
    Route::get('/pages', function () {
        $allpages = Page::where('active', '=', 1)->where('showinmenu', '=', 1)->get();
        $pages = array();
        foreach ($allpages as $page) {
            array_push($pages, array('slug' => $page->slug, 'title' => $page->title));
        }
        return Response::json($pages);
    });
});

// THIS NEEDS TO BE AT THE BOTTOM TO MAKE ALL OTHER ROUTES WORK
Route::get('/{slug}', ['middleware' => 'setTheme:vobilet', 'as' => 'page', 'uses' => 'Page\PagesController@show']);
