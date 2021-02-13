<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All the Routes for the WebsyBox App setup.
|
*/

Route::group(['middleware' => ['web']], function () {

    /*
    |--------------------------------------------------------------------------
    | Home Route
    |--------------------------------------------------------------------------
    |
    | Homepage for an authenticated store. Store is checked with the auth:session
    | middleware and redirected to login if not.
    |
    */

    Route::get(
        '/',
        '\App\Http\Controllers\HomeController@index'
    )
        ->name('home');
});
