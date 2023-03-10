<?php

namespace App\Http\Controllers\API\V1\UserInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersInfo\UserInfoUpdateRequest;
use App\Http\Resources\V1\ContactUser\ContactUserInfoResource;
use App\Http\Resources\V1\UserInfo\UserInfo;

class UserInfoController extends Controller
{

    public function update(UserInfoUpdateRequest $request)
    {
        // get user
        $user = auth()->user();
        $user->update($request->validated());

        $user_details = new UserInfo($user);
        $user_details = $user_details->toArray($request);

        // response
        $response = APIResponse('username info updated.', 200, true);
        $response->setData($user_details);
        $response->send();
    }

}
