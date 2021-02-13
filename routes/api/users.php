<?php

/*
|--------------------------------------------------------------------------
| UserResource Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('users', '\App\Http\Controllers\UserController')
        ->except(['create', 'edit', 'view', 'list']);

});
