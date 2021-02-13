<?php

Route::group(['middleware' => ['web', 'auth-web']], function () {

    Route::resource('users', '\App\Http\Controllers\UserController')
        ->only(['create', 'edit', 'view', 'list']);
});
