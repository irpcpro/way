<?php

namespace App\Http\Controllers\API\V1\Attachment;

use App\Enums\AttachmentTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attachment\AttachmentRequest;
use App\Http\Resources\V1\Attachment\AttachmentResource;
use App\Models\Attachment;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use function APIResponse;
use function auth;
use function public_path;
use const ATTACHMENT_DIR_ACCESS;
use const ATTACHMENT_DIR_NAME;
use const ATTACHMENT_IMAGE_DIR_ACCESS;
use const ATTACHMENT_IMAGE_DIR_NAME;
use const ATTACHMENT_IMAGE_FINAL_EXT;
use const ATTACHMENT_IMAGE_FINAL_QUALITY;

class AttachmentController extends Controller
{

    public function upload(AttachmentRequest $request)
    {
        // get attachment field
        $attachment = $request->validated('attachment');
        $type = (int)$request->validated('type');
        $current_user = auth()->user();

        // create attachment name & path
        $attachment_name = time() . chr(rand(97,122)) . rand(11111,99999);
        $attachment_path = ATTACHMENT_DIR_NAME . '/';
        $upload_attachment_path = public_path($attachment_path);

        // create attachment path if not exists
        if(!File::exists($upload_attachment_path))
            File::makeDirectory($upload_attachment_path, ATTACHMENT_DIR_ACCESS, true);


        // move attachment to host and resize if it's image and change extension image
        if($type == AttachmentTypeEnum::IMAGE->value){
            $final_extension = ATTACHMENT_IMAGE_FINAL_EXT;
            $attachment_final_type_path = ATTACHMENT_IMAGE_DIR_NAME . '/';
            $upload_final_type_path = public_path($attachment_final_type_path);

            // create attachment path if not exists
            if(!File::exists($upload_final_type_path))
                File::makeDirectory($upload_final_type_path, ATTACHMENT_IMAGE_DIR_ACCESS, true);

            $final_upload_path = $upload_final_type_path . $attachment_name . '.' . $final_extension;

            Image::make($attachment)
                ->save($final_upload_path)
                ->encode($final_extension, ATTACHMENT_IMAGE_FINAL_QUALITY);
        }else{
            // TODO - do for other type of attachment
        }

        // insert attachment details
        $final_attachment = Attachment::create([
            'id_user' => $current_user->id_user,
            'type' => $type,
            'name' => $attachment_name,
            'extension' => $final_extension,
            'path' => $attachment_final_type_path,
            'size_b' => File::size($final_upload_path),
        ]);

        $data = new AttachmentResource($final_attachment);
        $data = $data->toArray($request);

        // send response
        $response = APIResponse('avatar uploaded.', 200, true);
        $response = $response->setData($data);
        $response->send();
    }

}
