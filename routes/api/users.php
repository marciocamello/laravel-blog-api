<?php

/*
|--------------------------------------------------------------------------
| Users Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('users', '\App\Http\Controllers\UserController')
        ->except(['create', 'edit', 'view', 'list']);

    Route::put('users/change-password/{user}', '\App\Http\Controllers\UserController@changePassword')
        ->name('users.change_password');

    Route::put('users/change-email/{user}', '\App\Http\Controllers\UserController@changeEmail')
        ->name('users.change_email');

    Route::put('users/acl/{user}', '\App\Http\Controllers\UserController@acl')
        ->name('users.acl');

});
