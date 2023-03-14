<?php

namespace App\Http\Resources\V1\Chat;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SendMessageResource extends JsonResource
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
        return [
            'id_message_hook' => $this->id_message_hook,
            'id_user' => $this->id_user,
            'context' => $this->context,
            'type' => $this->type,
        ];
    }
}
