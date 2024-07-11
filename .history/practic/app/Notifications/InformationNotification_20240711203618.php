<?php

namespace App\Notifications;

use App\Models\Information;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InformationNotification extends Notification
{
    use Queueable;

    private Information $information;

    /**
     * Create a new notification instance.
     *
     * @param Information $information
     */
    public function __construct(Information $information)
    {
        $this->information = $information;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'date' => $this->information->date,
            'title' => $this->information->title,
            'content' => $this->information->content
             //  通知からリンクしたいURLがあれば設定しておくと便利
            //  'url' => route('infos.show', ['information' => $this->information])
        ];
    }
