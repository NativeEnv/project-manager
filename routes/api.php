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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * v1 rest version
 */
Route::group(['prefix' => 'v1'], function() {
    /**
     * Auth
     */
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', 'API\v1\AuthController@login');
        Route::post('refresh', 'API\v1\AuthController@refresh')->middleware('auth:api');
        Route::post('logout', 'API\v1\AuthController@logout')->middleware('auth:api');
    });

    /**
     * Users
     */
    Route::group(['prefix' => 'users'], function() {
        Route::post('', 'API\v1\UserController@create');
        Route::get('{id}', 'API\v1\UserController@show')->where('id', '\d+')->middleware('auth:api');
    });
});
