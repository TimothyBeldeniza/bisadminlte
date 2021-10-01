<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubmitRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $email;
    public $unique_code;
    public $brgyName;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email,$unique_code,$name,$brgyName)
    {
        $this->email = $email;
        $this->unique_code = $unique_code;
        $this->name = $name;
        $this->brgyName = $brgyName;
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
