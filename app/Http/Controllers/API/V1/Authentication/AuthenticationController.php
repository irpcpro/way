<?php

namespace App\Http\Controllers\API\V1\Authentication;

use App\Http\Requests\Authentication\registerRequest;

class AuthenticationController
{

    public function register(registerRequest $request)
    {
        // create user

        // send sms

        // response
        $response = APIResponse('کاربر ایجاد شد', 200, true);
        $response = $response->setData($request->validated());
        return $response->send();
    }

}
