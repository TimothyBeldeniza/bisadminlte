<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProcessRequestedDocument
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $unique_code;
    public $name;
    public $brgy;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email,$unique_code,$name,$brgy)
    {
        $this->email = $email;
        $this->unique_code = $unique_code;
        $this->name = $name;
        $this->brgy = $brgy;
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
