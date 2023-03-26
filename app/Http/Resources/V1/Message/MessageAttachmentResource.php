<?php

namespace App\Http\Resources\V1\Message;

use App\Models\MessageAttachment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageAttachmentResource extends JsonResource
{

    public function __construct(MessageAttachment $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array | null
    {
        if($this->resource == null)
            return null;

        return [
            'id_message_attachment' => $this->id_message_attachment,
            'url' => $this->url,
            'name' => $this->name,
            'type' => $this->type,
            'extension' => $this->extension,
            'created_at' => $this->created_at,
        ];
    }
}
