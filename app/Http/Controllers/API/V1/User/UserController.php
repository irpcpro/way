<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Requests\Users\UserDeleteAvatarRequest;
use App\Http\Requests\Users\UserSetAvatarRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UserController
{

    public function update(UserUpdateRequest $request)
    {
        // get user
        $user = auth()->user();
        $user->update($request->validated());

        // response
        $response = APIResponse('username info updated.', 200, true);
        $response->setData($user->toArray());
        $response->send();
    }

    public function set_avatar(UserSetAvatarRequest $request)
    {
        // get avatar field
        $avatar = $request->validated('avatar');

        // create avatar name & path
        $image_name = time() . chr(rand(97,122)) . rand(11111,99999);
        $path = AVATAR_DIR_NAME . '/';
        $upload_path = public_path($path);

        // create avatar path if not exists
        if(!File::exists($upload_path))
            File::makeDirectory($upload_path, AVATAR_DIR_ACCESS, true);

        // move avatar to host and resize and change extension
        $final_extension = AVATAR_FINAL_EXT;
        $final_upload_path = $upload_path . $image_name . '.' . $final_extension;
        Image::make($avatar)
            ->fit(AVATAR_FINAL_WIDTH, AVATAR_FINAL_HEIGHT)
            ->save($final_upload_path)
            ->encode($final_extension, AVATAR_FINAL_QUALITY);

        // insert avatar details
        $final_avatar = Avatar::create([
            'name' => $image_name,
            'extension' => $final_extension,
            'path' => $path,
            'width' => AVATAR_FINAL_WIDTH,
            'height' => AVATAR_FINAL_HEIGHT,
            'user_id' => auth()->user()->id,
        ]);

        // send response
        $response = APIResponse('avatar uploaded.', 200, true);
        $response = $response->setData($final_avatar->toArray());
        $response->send();
    }

    public function get_last_avatar()
    {
        $data = auth()->user()->avatar()->first()->toArray();
        $response = APIResponse('avatar get successfully', 200, true);
        $response = $response->setData($data);
        $response->send();
    }

    public function get_avatars()
    {
        $data = auth()->user()->avatars();
        $data = $data->get();
        $data = $data->toArray();
        $response = APIResponse('avatar get successfully', 200, true);
        $response = $response->setData($data);
        $response->send();
    }

    public function delete_avatar(UserDeleteAvatarRequest $request, Avatar $id)
    {
        // get avatar
        $avatar = $id;

        // remove file from public
        $file_full_path = public_path($avatar->full_path);
        if(File::exists($file_full_path))
            File::delete($file_full_path);

        // delete avatar row record
        $avatar->delete();

        // send response
        APIResponse('avatar deleted successfully', 200, true)->send();
    }

}
