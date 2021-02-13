<?php

/*
|--------------------------------------------------------------------------
| Users Route
|--------------------------------------------------------------------------
|
*/

Route::get('/login', '\App\Http\Controllers\DashboardController@login')
    ->name('dashboard.login');

Route::get('/remember-password', '\App\Http\Controllers\DashboardController@rememberPassword')
    ->name('dashboard.remember-password');

Route::get('/register', '\App\Http\Controllers\DashboardController@register')
    ->name('dashboard.register');

Route::group(['middleware' => ['web', 'auth-web']], function () {

    Route::get('/', '\App\Http\Controllers\DashboardController@index')
        ->name('dashboard.index');
});
