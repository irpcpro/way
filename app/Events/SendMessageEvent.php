<?php

namespace App\Events;

use App\Http\Resources\V1\Chat\NewMessageResource;
use App\Models\Message;
use App\Models\MessageHook;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Message $message
    )
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('new_messages.id_message_hook.' . $this->message->id_message_hook),
        ];
    }

    public function broadcastWith()
    {
        return (new NewMessageResource($this->message))->toArray(request());
    }

    /**
     * set broadcast name as
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'new_messages';
    }

}
