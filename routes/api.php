<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::namespace('V1')->prefix('v1')->group(function () {
    // authentication
    Route::prefix('auth')->namespace('Authentication')->controller('AuthenticationController')->group(function () {
        Route::post('send_code', 'send_code');
        Route::post('confirmation_code', 'confirmation_code');
    });


    Route::get('get-chats', 'Chat\ChatController@getListChats');
//    Route::get('get-chats', function(){
//        $current_user = User::where('id_user', 1)->first();
//        $current_id_user = $current_user->id_user;
//        $messages = $current_user->message_hook_member()->first();
//
//        dd($messages->message_hook->messages->first());
//
//        $messages = $messages->with([
//            'message_hook' => function($query) use ($current_id_user){
//                $query->with([
//                    'messages' => function($query2){
////                        $query2->latest()->first();
////                        $query2->orderByDesc('created_at')->get();
//                        $query2->latest()->first();
////                        $query2->select(DB::raw('MAX(created_at) as latest_message_time'));
//                    },
//                    'message_hook_members' => function($query3) use ($current_id_user){
//                        $query3->where('id_user', '!=', $current_id_user);
//                    }
//                ]);
//            }
//        ]);
//        $messages = $messages->get();
//    });

    // private routes
    Route::middleware('auth:api')->group(function(){

        // user
        Route::prefix('user')->namespace('User')->controller('UserController')->group(function(){
            // get current user details
        });

        // info
        Route::prefix('user-info')->namespace('UserInfo')->controller('UserInfoController')->group(function(){
            Route::put('update', 'update');
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
            Route::get('get-list-chats', 'getListChats');

        });

    });

});
