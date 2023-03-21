<?php

namespace App\Http\Controllers\API\V1\Websocket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Websocket\AuthNewMessagesRequest;
use App\Models\MessageHookMembers;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use BeyondCode\LaravelWebSockets\Apps\App;
use Pusher\Pusher;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class WebsocketController extends Controller
{

    public string $app_id;
    public string $channel_name_key;

    public function __construct()
    {
        $this->app_id = env('PUSHER_APP_ID');
        $this->channel_name_key = SEND_TO_MEMBERS_MESSAGE_HOOK_PREFIX_CHANNEL_NAME . SEND_TO_MEMBERS_MESSAGE_HOOK_CHANNEL_NAME;
    }

    protected function channelNameMatchesPattern($channel, $pattern)
    {
        return preg_match('/^'.preg_replace('/\{(.*?)\}/', '([^\.]+)', $pattern).'$/', $channel);
    }

    public function authNewMessages(AuthNewMessagesRequest $request)
    {
        // get pusher app setting
        $app = App::findById($this->app_id);
        $channel_names = $request->validated('channel_names');
        $user = auth()->user();

        // get id_message_hook and check for user access to message hook
        $id_message_hook = [];
        foreach ($channel_names as $channel_name){
            // get id_message_hook
            $id = (int) str_replace($this->channel_name_key, '', $channel_name);
            if($id == null || $id == '' || $id == 0)
                throw new AccessDeniedHttpException;

            $id_message_hook[] = $id;
        }
        // check if user is member of this message_hook
        $message_hook_member = MessageHookMembers::query();
        $message_hook_member = $message_hook_member->where('id_user', $user->id_user);
        $message_hook_member = $message_hook_member->whereIn('id_message_hook', $id_message_hook);
        if($message_hook_member->exists() === false || $message_hook_member->count() != count($id_message_hook))
            throw new AccessDeniedHttpException;


        // collect auth
        $collect_auth = [];
        // get all auth for each channel_names
        foreach ($channel_names as $channel_name){
            // create pusher class object
            $PusherBroadcaster = new PusherBroadcaster(new Pusher(
                $app->key,
                $app->secret,
                $app->id,
                []
            ));

            // set channel_name
            $request = $request->merge([
                'channel_name' => $channel_name
            ]);

            // collect auth for each channels
            $collect_auth[] = array_merge(
                [
                    'channel_name' => $channel_name
                ],
                $PusherBroadcaster->validAuthenticationResponse($request, [])
            );
        }

        APIResponse('data received.', 200, true)->setData($collect_auth)->send();
    }

}
