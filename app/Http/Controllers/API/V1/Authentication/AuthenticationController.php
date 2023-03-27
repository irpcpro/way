<?php

namespace App\Http\Controllers\API\V1\Authentication;

use App\Events\AuthenticationCodeEvent;
use App\Http\Requests\Authentication\ConfirmationCodeRequest;
use App\Http\Requests\Authentication\SendCodeRequest;
use App\Models\User;
use Carbon\Carbon;

class AuthenticationController
{

    public function send_code(SendCodeRequest $request)
    {
        $mobile = $request->validated()['mobile'];
        // create user
        $user = User::where('mobile', $mobile);
        if(!$user->exists())
            $user = User::create($request->validated());
        else
            $user = $user->first();

        // check if user request is passed
        $auth_code = $user->authenticationCodes();
        $auth_code = $auth_code->getUserLastActiveCode();
        if($auth_code->exists()){
            $time_left = Carbon::parse($auth_code->first()->created_at)->diffInSeconds(now()->subSecond(AUTH_CODE_EXPIRE_TIME));
            $data = [
                'time_left' => $time_left,
                'mobile' => $mobile,
            ];

            // response
            $response = APIResponse('you have just requested now.', 422);
            $response = $response->setData($data);
            $response->send();
        }else{
            // send code
            event(new AuthenticationCodeEvent($user));

            $data = [
                'time_left' => AUTH_CODE_EXPIRE_TIME,
                'mobile' => $request->validated('mobile')
            ];

            // response
            $response = APIResponse('authentication code send successfully.', 200, true);
            $response = $response->setData($data);
            $response->send();
        }
    }

    public function confirmation_code(ConfirmationCodeRequest $request)
    {
        // get inputs
        $mobile = $request->validated()['mobile'];
        $code = $request->validated()['code'];

        // get user
        $user = User::where('mobile', $mobile);
        if(!$user->exists())
            APIResponse('user not found with this mobile number', 422)->send();

        // get user
        $user = $user->first();

        // check if user have code
        $auth_code = $user->authenticationCodes();
        $auth_code = $auth_code->getUserLastActiveCode();

        // check if user have and code
        if(!$auth_code->exists())
            APIResponse('code was expired.', 422)->send();

        // get code
        $auth_code = $auth_code->first();

        // check code
        if($auth_code->code != $code)
            APIResponse('code is incorrect.', 401)->send();

        // expire code
        $auth_code->update([
            'expired' => true
        ]);

        // update user active status
        if(!$user->active)
            $user->update([
                'active' => true
            ]);

        // generate token and sent
        $data = [
            'token' => auth('api')->login($user) ?? null
        ];

        $response = APIResponse('you are logged in.', 200, true);
        $response = $response->setData($data);
        $response->send();
    }

}
