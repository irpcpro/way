<?php

namespace App\Http\Resources\V1\Message;

use App\Models\MessageSeen;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageSeenResource extends JsonResource
{

    public function __construct(MessageSeen $resource)
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
        return [
            'id_message_seen' => $this->id_message_seen,
            'id_message' => $this->id_message_seen,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->user,
        ];
    }
}
