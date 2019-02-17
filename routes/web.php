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

Route::get('/', function () {
    $instagram = json_encode(config('services.instagram.public'));
    return view('welcome', compact('instagram'));
});

// So history mode can work in VueRouter
// without having to configure server rewrite
Route::get('/{any}', function () {
    return redirect('/');
})->where('any', '.*');
