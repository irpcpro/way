<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::namespace('V1')->prefix('v1')->group(function () {
    // authentication
    Route::prefix('auth')->namespace('Authentication')->controller('AuthenticationController')->group(function () {
        Route::post('send_code', 'send_code');
        Route::post('confirmation_code', 'confirmation_code');
    });

    // private routes
    Route::middleware('auth:api')->group(function(){
        // websocket
        Route::prefix('websocket')->namespace('Websocket')->controller('WebsocketController')->group(function(){
            // authorization
            Route::post('auth-new-messages', 'authNewMessages');

        });

        // user
        Route::prefix('user')->namespace('User')->controller('UserController')->group(function(){
            // get current user details
        });

        // user
        Route::prefix('user')->namespace('User')->group(function(){
            // info
            Route::prefix('info')->controller('UserInfoController')->group(function(){
                Route::get('/', 'get');
                Route::put('update', 'update');
            });

        });

        // avatars
        Route::prefix('avatar')->namespace('Avatar')->controller('AvatarController')->group(function(){
            Route::post('set_avatar', 'set_avatar');
            Route::get('get_last_avatar', 'get_last_avatar');
            Route::get('get_avatars', 'get_avatars');
            Route::delete('delete_avatar/{avatar}', 'delete_avatar');
        });

        // search
        Route::prefix('search-user')->namespace('SearchUser')->controller('SearchUserController')->group(function(){
            Route::get('search', 'search');
        });

        // contacts
        Route::prefix('contacts')->namespace('Contacts')->controller('ContactsController')->group(function(){
            Route::get('list', 'list');
            Route::post('add', 'add');
            Route::put('update/{contact}', 'update');
            Route::delete('delete/{contact}', 'delete');
        });

        // chat
        Route::prefix('chat')->namespace('Chat')->controller('ChatController')->group(function(){
            Route::post('send-message', 'sendMessage');
            Route::get('get-messages/{message_hook}/{offset?}', 'getMessages')->where([
                'message_hook' => '[0-9]+',
                'offset' => '[0-9]+'
            ]);
            Route::get('get-list-chats', 'getListChats');
        });

    });

});
