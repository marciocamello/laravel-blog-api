<?php

/*
|--------------------------------------------------------------------------
| UserResource Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('medias', '\App\Http\Controllers\MediaController')->except(['update']);
    Route::post('medias/{media}', '\App\Http\Controllers\MediaController@update');

});
