<?php

use Illuminate\Support\Facades\Route;



Route::namespace('V1')->prefix('v1')->group(function () {
    // authentication
    Route::prefix('auth')
        ->namespace('Authentication')
        ->controller('AuthenticationController')
        ->group(function () {
            Route::post('send_code', 'send_code');
            Route::post('confirmation_code', 'confirmation_code');
        });

    // private routes
    Route::middleware('auth:api')->group(function(){
        // user info
        Route::prefix('user')
            ->namespace('User')
            ->controller('UserController')
            ->group(function(){
                Route::put('update', 'update');
                Route::post('set_avatar', 'set_avatar');
                Route::get('get_last_avatar', 'get_last_avatar');
                Route::get('get_avatars', 'get_avatars');
                Route::delete('delete_avatar/{id}', 'delete_avatar');
            });





    });

});
