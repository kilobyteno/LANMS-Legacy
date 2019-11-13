<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => 'api'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/stats', [
        'as' => 'api-stats',
        'uses' => 'API\APIController@stats'
    ]);

    Route::get('/news/{amount}', [
        'as' => 'api-news',
        'uses' => 'API\APIController@news'
    ]);

    Route::get('/news/{amount}/{skip}', [
        'as' => 'api-news-skip',
        'uses' => 'API\APIController@skipNews'
    ]);
});


// Test Routes
Route::group(['prefix' => 'v2', 'middleware' => 'client'], function () {
    Route::get('/cars', function (Request $request) {
        return response()->json([
            'cars' => [
                'registration' => 'ABC001',
                'dateRegistered' => '2019-01-01',
                'color' => 'black',
                'make' => 'tesla',
                'model' => 's'
            ]
        ], 200);
    });

    Route::get('/user/checkin', [
        'as' => 'api-v2-user-checkin-all',
        'uses' => 'API\v2Controller@userCheckinAll'
    ]);

    Route::get('/user/checkin/{id}', [
        'as' => 'api-v2-user-checkin',
        'uses' => 'API\v2Controller@userCheckin'
    ]);

});
