<?php

namespace App\Http\Controllers\API\V1\Avatar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Avatar\AvatarDeleteRequest;
use App\Http\Requests\Avatar\AvatarSetRequest;
use App\Http\Resources\V1\Avatar\AvatarResource;
use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AvatarController extends Controller
{

    public function set_avatar(AvatarSetRequest $request)
    {
        // get avatar field
        $avatar = $request->validated('avatar');
        $current_user = auth()->user();

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
            'id_user' => $current_user->id_user,
        ]);

        $data = new AvatarResource($current_user->avatar);
        $data = $data->toArray($request);

        // send response
        $response = APIResponse('avatar uploaded.', 200, true);
        $response = $response->setData($data);
        $response->send();
    }

    public function get_last_avatar(Request $request)
    {
        $current_user = auth()->user();
        $avatar = new AvatarResource($current_user->avatar);
        $avatar = $avatar->toArray($request);

        $response = APIResponse('avatar get successfully', 200, true);
        $response = $response->setData($avatar);
        $response->send();
    }

    public function get_avatars(Request $request)
    {
        $current_user = auth()->user();
        $avatars = $current_user->avatars()->get();
        $avatars = AvatarResource::collection($avatars);
        $avatars = $avatars->toArray($request);

        $response = APIResponse('avatar get successfully', 200, true);
        $response = $response->setData($avatars);
        $response->send();
    }

    public function delete_avatar(AvatarDeleteRequest $request, Avatar $avatar)
    {
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
