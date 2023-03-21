<?php

namespace App\Events;

use App\Http\Resources\V1\Chat\NewMessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNewConversationsEvents implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channelName;

    public function __construct(
        public User $user,
        public Message $message
    )
    {
        $this->channelName = USER_CHANNEL_NAME;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel($this->channelName . $this->user->id_user);
    }

    public function broadcastWith()
    {
        return (new NewMessageResource($this->message))->toArray(request());
    }

    public function broadcastAs(): string
    {
        return 'new_conversations';
    }

}
