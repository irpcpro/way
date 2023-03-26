<?php

namespace App\Events;

use App\Http\Resources\V1\Message\MessageNewResource;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendToMembersMessageHookEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channelName;

    public function __construct(
        public Message $message
    )
    {
        $this->channelName = SEND_TO_MEMBERS_MESSAGE_HOOK_CHANNEL_NAME;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel($this->channelName . $this->message->id_message_hook),
        ];
    }

    public function broadcastWith()
    {
        return (new MessageNewResource($this->message))->toArray(request());
    }

    public function broadcastAs(): string
    {
        return 'new_messages';
    }

}
