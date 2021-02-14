<?php

/*
|--------------------------------------------------------------------------
| UserResource Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('posts', '\App\Http\Controllers\PostController')->except(['update']);
    Route::post('posts/{post}', '\App\Http\Controllers\PostController@update');

});
