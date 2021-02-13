<?php

/*
|--------------------------------------------------------------------------
| UserResource Route
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    Route::resource('comments', '\App\Http\Controllers\CommentController');

});
