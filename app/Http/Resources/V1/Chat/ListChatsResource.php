<?php

namespace App\Http\Resources\V1\Chat;

use App\Http\Resources\V1\UserInfo\UserInfo;
use App\Models\MessageHook;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListChatsResource extends JsonResource
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
            'id_message_hook' => $message->id_message_hook,
            'id_message' => $message->id_message,
            'type' => $message->type,
            'context' => $message->context,
            'created_at' => $message->created_at,
            'updated_at' => $message->updated_at,
            'user' => new UserInfo($user_member->user)
        ];
    }
}
