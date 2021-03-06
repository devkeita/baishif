<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["middleware" => "api"], function () {

    Route::post('/register', 'Auth\SecurityController@register');

    Route::post('/login', 'Auth\SecurityController@login');

    Route::get('/shift/share', 'ShareController@getByShareId');

    Route::group(['middleware' => ['jwt.auth']], function () {

        Route::get('/me', 'Auth\SecurityController@getUser');

        Route::post('/logout', 'Auth\SecurityController@logout');

        Route::resource('company', 'CompanyController')->except([
            'create'
        ]);

        Route::resource('shift', 'ShiftController')->except([
            'create'
        ]);

        Route::patch('/shift/share/set', 'ShareController@setShareId');

        Route::patch('/shift/share/delete', 'ShareController@deleteShareId');
    });
});
