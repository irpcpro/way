<?php

namespace App\Http\Controllers\API\V1\Message;

use App\Enums\MessageHookTypeEnum;
use App\Enums\MessageTypeEnum;
use App\Events\SendToMembersMessageHookEvent;
use App\Events\UserNewConversationsEvents;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageSendRequest;
use App\Http\Requests\Message\MessagesGetRequest;
use App\Http\Requests\Message\MessageSeenRequest;
use App\Http\Resources\V1\Message\MessageResource;
use App\Http\Resources\V1\Message\MessagesGetCollection;
use App\Http\Resources\V1\Message\MessagesListResource;
use App\Models\Message;
use App\Models\MessageHook;
use App\Models\MessageHookMembers;
use App\Models\MessageSeen;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
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

            // TODO - add event for send PushNotification
            // UserNewConversationsEvents
        }
        return $id_message_hook;
    }

    public function send(MessageSendRequest $request)
    {
        $id_message_hook = $request->validated('id_message_hook');
        $id_user = $request->validated('id_user');
        $context = $request->validated('context');
        $current_user = auth()->user();
        $type = $request->validated('type');
        $id_attachment = $request->validated('id_attachment');

        DB::beginTransaction();
        try {
            // if id_message_hook has added, just send message
            $id_users = [];
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
                'type' => $type,
                'context' => $context,
            ]);

            // add attachment to pivot if type message is attachment
            if($type == MessageTypeEnum::ATTACHMENT->value){
                $message->attachments()->attach($id_attachment);
            }

            // broadcast message to Users or Members_message_hook
            if(empty($id_users)){
                // TODO - add event for send PushNotification
                event(new SendToMembersMessageHookEvent($message));
            }else{
                // TODO - add event for send PushNotification
                $getUsers = User::whereIn('id_user', $id_users)->get();
                if($getUsers->count()){
                    foreach ($getUsers as $user)
                        event(new UserNewConversationsEvents($user, $message));
                }
            }

            // set data to response
            $data = new MessageResource($message);
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

    public function get(MessagesGetRequest $request, MessageHook $message_hook, $offset = null)
    {
        // get messages
        $messages = Message::query();
        // if there was an offset, get messages before (oldest) offset
        if(isset($offset) && $offset !== null)
            $messages = $messages->where('id_message', '<', $offset);
        $messages = $messages->where('id_message_hook', $message_hook->id_message_hook);
        $messages = $messages->latest();
        $messages = $messages->take(PAGINATE_MESSAGE_LOAD);
        $messages = $messages->get();
        $messages = new MessagesGetCollection($messages);
        $messages = $messages->toArray($request);

        // return response
        APIResponse('messages received.', 200, true)->setData($messages)->send();
    }

    public function list(Request $request)
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
            return (new MessagesListResource($item->message_hook))->toArray($request);
        });
        $data = $data->sortByDesc('created_at');
        $data = $data->toArray();
        $data = array_values($data);

        APIResponse('data received.', 200, true)->setData($data)->send();
    }

}
