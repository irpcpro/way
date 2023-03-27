<?php

namespace App\Http\Resources\V1\Message;

use App\Enums\MessageTypeEnum;
use App\Http\Resources\V1\Attachment\AttachmentResource;
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

        $data = [
            'id_message' => $this->id_message,
            'id_message_hook' => $this->id_message_hook,
            'id_user' => $this->id_user,
            'context' => $this->context != ''? $this->context : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->type,
            'seen' => $seen,
        ];

        // if type is attachment, add attachment details to message
        if($this->type == MessageTypeEnum::ATTACHMENT->value)
            $data['attachment'] = (new AttachmentResource($this->attachments()->first()))->toArray($request);

        return $data;
    }
}
