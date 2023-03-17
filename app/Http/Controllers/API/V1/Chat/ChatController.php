<?php

namespace App\Http\Controllers\API\V1\Chat;

use App\Enums\MessageHookTypeEnum;
use App\Enums\MessageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\SendMessageRequest;
use App\Http\Resources\V1\Chat\ListChatsResource;
use App\Http\Resources\V1\Chat\SendMessageResource;
use App\Models\Message;
use App\Models\MessageHook;
use App\Models\MessageHookMembers;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ChatController extends Controller
{

    private function createHooksAndMembers(MessageHookTypeEnum $msgHookType, array $id_users): int
    {
        // create message hook
        $message_hook = MessageHook::create([
            'type' => $msgHookType
        ]);
        $id_message_hook = $message_hook->id_message_hook;

        // create message members
        foreach ($id_users as $id_user){
            // create message hook members
            MessageHookMembers::create([
                'id_message_hook' => $id_message_hook,
                'id_user' => $id_user,
            ]);
        }
        return $id_message_hook;
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $id_message_hook = $request->validated('id_message_hook');
        $id_user = $request->validated('id_user');
        $context = $request->validated('context');
        $current_user = auth()->user();

        DB::beginTransaction();
        try {
            // if id_message_hook has added, just send message
            if(!isset($id_message_hook) || $id_message_hook == null){
                $id_users = [
                    $current_user->id_user,
                    $id_user
                ];
                $id_message_hook = $this->createHooksAndMembers(MessageHookTypeEnum::PRIVATE, $id_users);
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
            $response = APIResponse('something went wrong..', 500)->get();
        }

        // return response
        throw new HttpResponseException(
            $response
        );
    }

    public function getListChats(Request $request)
    {
        $current_user = auth()->user();
        $current_id_user = $current_user->id_user;
        $messages = $current_user->message_hook_member();
        $messages = $messages->with([
            'message_hook.message_hook_members' => function($query) use ($current_id_user){
                $query->where('id_user', '!=', $current_id_user);
            }
        ]);
        $messages = $messages->get();
        $data = $messages->map(function($item) use ($request){
            return (new ListChatsResource($item->message_hook))->toArray($request);
        });
        $data = $data->sortByDesc('created_at');
        $data = $data->toArray();
        $data = array_values($data);

        APIResponse('data received.', 200, true)->setData($data)->send();
    }

}
