<?php

namespace App\Http\Controllers\API\V1\SearchUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchUser\SearchUserRequest;
use App\Http\Resources\V1\User\UserInfo;
use App\Models\User;

class SearchUserController extends Controller
{

    public function search(SearchUserRequest $request)
    {
        // get inputs
        $mobile = $request->validated('mobile');
        $username = $request->validated('username');

        // search user
        $find_user = User::query();
        $find_user = ($mobile != null)
            ? $find_user->where('mobile', '=', $mobile)
            : $find_user->where('username', '=', $username);

        // if nothing found
        if(!$find_user->exists())
            APIResponse('user not found.')->send();
        $find_user = $find_user->first();
        $find_user = new UserInfo($find_user, $mobile);
        $find_user = $find_user->toArray($request);

        // response the answer
        $response = APIResponse('user found.', 200, true);
        $response = $response->setData($find_user);

        $response->send();
    }

}
