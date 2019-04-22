<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;
use App\Order;
use App\Item;

class OrderPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $order;

    public $item;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order, Item $item)
    {
        $this->user = $user;
        $this->order = $order;
        $this->item = $item;
    }

    public function broadcastAs()
    {
        return 'OrderPlaced';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('orders');
    }
}
