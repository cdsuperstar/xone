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

    public $msg;
    public $create_at;
    private $touserid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($touserid, $msg)
    {
        //
        $this->msg = $msg;
        $this->create_at = now()->format('Y-m-d H:i:s');
        $this->touserid = $touserid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
        return new PrivateChannel('App.Models.User.' . $this->touserid);
    }
}
