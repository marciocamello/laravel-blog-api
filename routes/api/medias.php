<?php

/*
|--------------------------------------------------------------------------
| Users Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('medias', '\App\Http\Controllers\MediaController');

});
