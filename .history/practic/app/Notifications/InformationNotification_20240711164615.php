<?php

namespace App\Notifications;

// use App\Mail\AdminNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformationNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $content;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
        //
    }

    /**
     * メール、データベース通知を指定
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail', 'database'];
        return ['database'];
    }

    /**
     * メール通知の送信
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject($this->title)
                ->markdown('mail.notification', ['title' => $this->title, 'content' => $this->content]);
    }

    /**
     * 通知をデータベースに保存
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
