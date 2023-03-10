<?php

namespace App\Listeners;

use App\Events\AuthenticationCodeEvent;
use App\Http\Controllers\Systems\AuthenticationCode\AuthenticationCodeController;

class SendAuthenticationCodeListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuthenticationCodeEvent $event): void
    {
        // get code
        $get_code = (new AuthenticationCodeController($event->user))->getCode();
        if($get_code != false){
            // send code
            // TODO - set sms Service to send code
            // SMS($get_code)
        }
    }
}
