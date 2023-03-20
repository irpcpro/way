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

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id_user === (int) $id;
//});

Broadcast::channel('new_messages.user.{id_user}', function($user){
    \Illuminate\Support\Facades\Log::error('wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww - ' . \Carbon\Carbon::now());
//    return (int) $user->id === (int) $userId;
    return true;
    return $user;
});



