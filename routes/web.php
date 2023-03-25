<?php

use App\Events\SendToMembersMessageHookEvent;
use App\Events\UserNewConversationsEvents;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

//    event(new UserNewConversationsEvents(\App\Models\User::where('id_user', 1)->first()));
//    \App\Models\MessageSeen::create([
//        'id_message' => 40,
//        'id_user' => 1
//    ]);
//    \App\Models\MessageSeen::create([
//        'id_message' => 37,
//        'id_user' => 1
//    ]);

});
