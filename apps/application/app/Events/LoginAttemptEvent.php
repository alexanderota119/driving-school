<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class LoginAttemptEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  User  $user
     * @param  bool  $was_successful
     */
    public function __construct(public User $user, public Request $request, public bool $was_successful = true)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
