<?php

namespace App\Http\Resources\V1\Message;

use App\Http\Resources\V1\User\UserInfo;
use App\Models\MessageHook;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessagesListResource extends JsonResource
{

    public function __construct(MessageHook $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // get first of message from this
        $message = $this->messages()->latest()->first();
        // get user member except current user
        $user_member = $this->message_hook_members->first();
        return [
            'message' => (new MessageResource($message)),
            'user' => new UserInfo($user_member->user)
        ];
    }
}
