<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| All the Routes for the WebsyBox App setup.
|
*/
/*
|--------------------------------------------------------------------------
| Authenticate Route
|--------------------------------------------------------------------------
|
*/
Route::middleware(['api', 'auth:sanctum'])->get('authenticate/user', function (\Illuminate\Http\Request $request) {
    return $request->user();
});


Route::post('authenticate/login', '\App\Http\Controllers\Auth\AuthController@login')
    ->name('login');

Route::get('authenticate/logout', '\App\Http\Controllers\Auth\AuthController@logout')
    ->name('logout');

Route::post('authenticate/request-password', '\App\Http\Controllers\Auth\ForgotPasswordController@forgot')
    ->name('request-password');

Route::post('authenticate/reset-password/{token}', '\App\Http\Controllers\Auth\ForgotPasswordController@reset')
    ->name('reset-password');
