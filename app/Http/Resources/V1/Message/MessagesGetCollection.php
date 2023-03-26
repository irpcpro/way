<?php

namespace App\Http\Resources\V1\Message;

use App\Http\Resources\V1\User\UserInfo;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class MessagesGetCollection extends ResourceCollection
{

    public function __construct(Collection $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function(Message $message){
            return [
                'message' => (new MessageResource($message)),
                'user' => new UserInfo($message->user)
            ];
        })->toArray();
    }
}
