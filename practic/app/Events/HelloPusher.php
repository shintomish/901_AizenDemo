<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HelloPusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * コンストラクタ
     * 
     * @param string $message
     */
    public function __construct($message = 'hello pusher')
    {
        $this->message = $message;
    }

    /**
     * 送信先のチャンネル
     * @return array
     */
    public function broadcastOn()
    {
        return ['my-channel'];
    }


    /**
     * イベント名
     * @return string
     */
    public function broadcastAs()
    {
        return 'my-event';
    }
}