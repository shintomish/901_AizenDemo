<?php

namespace App\Events;

use App\Models\User;
// use App\Models\Customer;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCliantCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $organization_id;
    public $user_id;
    public $to_flg;
    public $to_user_id;
    public $customer_id;
    public $body;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public function __construct(User $user, Message $message)
    public function __construct(User $user, $organization_id, $to_flg, $user_id, $to_user_id, $customer_id, Message $body)
    {
        $this->user            = $user;
        $this->organization_id = $organization_id;
        $this->to_flg          = $to_flg;
        $this->user_id         = $user_id;
        $this->to_user_id      = $to_user_id;
        $this->customer_id     = $customer_id;
        $this->body            = $body;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new Channel('chat');         // Public
    //     // return new PrivateChannel('chat');  // Privateでは、更新されないのでPublicにした
    // }
        /**
     * イベントをブロードキャストすべき、チャンネルの取得
     *
     * @return Channel|Channel[]
     */
    public function broadcastOn()
    {
        return new Channel('chatcliant');
    }

    /**
     * ブロードキャストするデータを取得
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user'            => $this->user,
            'organization_id' => $this->organization_id,
            'to_flg'          => $this->to_flg,
            'user_id'         => $this->user_id,
            'to_user_id'      => $this->to_user_id,
            'customer_id'     => $this->customer_id,
            'message'         => $this->body,
        ];
    }
    /**
     * イベントブロードキャスト名
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'chatcliant_event';
    }
}
