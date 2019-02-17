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

Route::middleware('auth:api')
    ->name('user')
    ->get('/user', 'Api\Auth\UserController@show');

Route::middleware('api')
    ->name('authorize')
    ->post('/auth/authorize', 'Api\Auth\AuthorizeController@store');

Route::middleware('auth:api')
    ->name('logout')
    ->post('/auth/logout', 'Api\Auth\LogoutController@store');
