<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class msgEvt implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $create_at;
    public $reciver;
    public $sender;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($reciver, $message)
    {
        //
        $this->message = $message;
        $this->create_at = now()->format('Y-m-d H:i:s');
        $this->reciver = $reciver;
        $this->sender = auth('api')->user()->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
        return new PrivateChannel('App.Models.User.' . $this->reciver);
    }
}
