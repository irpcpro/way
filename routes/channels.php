<?php

use App\Broadcasting\UserChannel;
use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel(
//    'new_messages.id_message_hook.{id_message_hook}',
//    NewMessageToMessageHookChannel::class,
//    ['guards' => ['api'], 'middleware' => 'auth:api']
//);

Broadcast::channel(
    'user.{id_user}',
    UserChannel::class,
    ['guards' => ['api'], 'middleware' => 'auth:api']
);
