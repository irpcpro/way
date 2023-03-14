<?php

namespace App\Http\Controllers\API\V1\Chat;

use App\Enums\MessageHookTypeEnum;
use App\Enums\MessageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\SendMessageRequest;
use App\Http\Resources\V1\Chat\SendMessageResource;
use App\Models\Message;
use App\Models\MessageHook;
use App\Models\MessageHookMembers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ChatController extends Controller
{

    public function sendMessage(SendMessageRequest $request)
    {
        $id_message_hook = $request->validated('id_message_hook');
        $id_user = $request->validated('id_user');
        $context = $request->validated('context');
        $current_user = auth()->user();

        DB::beginTransaction();
        try {
            // if id_message_hook has added, just send message
            if(!isset($id_message_hook) && $id_message_hook == null){

                // TODO - generate this in another class

                // create message hook
                $message_hook = MessageHook::create([
                    'type' => MessageHookTypeEnum::PRIVATE
                ]);
                $id_message_hook = $message_hook->id_message_hook;

                // create message hook members
                MessageHookMembers::create([
                    'id_message_hook' => $id_message_hook,
                    'id_user' => $current_user->id_user,
                ]);
                MessageHookMembers::create([
                    'id_message_hook' => $id_message_hook,
                    'id_user' => $id_user,
                ]);
            }

            // save message
            $message = Message::create([
                'id_user' => $current_user->id_user,
                'id_message_hook' => $id_message_hook,
                'type' => MessageTypeEnum::TEXT,
                'context' => $context,
            ]);

            // TODO - add event for send Broadcast and PushNotification

            // set data to response
            $data = new SendMessageResource($message);
            $data = $data->toArray($request);
            $response = APIResponse('message sent.', 200, true)->setData($data)->get();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            Log::error('something went wrong in ' . __METHOD__, [$exception]);
            $response = APIResponse('something went wrong', 500)->get();
        }

        // return response
        throw new HttpResponseException(
            $response
        );
    }

}
