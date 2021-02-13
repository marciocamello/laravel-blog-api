<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.*', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('echo.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('services.{serviceId}', function ($user, $serviceId) {
    return true;
});

Broadcast::channel('room', \App\Broadcasting\UserStatusChannel::class);
Broadcast::channel('user.{id}', \App\Broadcasting\UserStatusChannel::class);
