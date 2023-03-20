<?php

use App\Events\SendMessageToUserEvent;
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

    $msg = \App\Models\Message::where('id_message', 56)->first();
    $user = \App\Models\User::where('id_user', 1)->first();

    broadcast(new SendMessageToUserEvent($msg, $user));

});
