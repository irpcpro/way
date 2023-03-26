<?php

namespace App\Http\Resources\V1\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    public function __construct(Message $resource)
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
        $seen = MessageSeenResource::collection($this->seen);
        $seen = $seen->toArray($request);

        return [
            'id_message' => $this->id_message,
            'id_message_hook' => $this->id_message_hook,
            'id_user' => $this->id_user,
            'context' => $this->context,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->type,
            'seen' => $seen,
        ];
    }
}
