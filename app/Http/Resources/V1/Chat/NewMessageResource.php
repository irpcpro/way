<?php

namespace App\Http\Resources\V1\Chat;

use App\Http\Resources\V1\UserInfo\UserInfo;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewMessageResource extends JsonResource
{

    public function __construct(Message $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'message' => (new MessageResource($this->resource)),
            'user' => new UserInfo($this->resource->user)
        ];
    }
}
