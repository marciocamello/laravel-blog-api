<?php

/*
|--------------------------------------------------------------------------
| Users Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('posts', '\App\Http\Controllers\PostController');

});
