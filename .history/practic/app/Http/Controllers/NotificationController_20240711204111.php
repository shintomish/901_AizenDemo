<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * 通知を既読にする
     *
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect($notification->data['url']);
    }

    /**
     * 全ての通知を既読にする
     *
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function readAll(DatabaseNotification $notification)
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect(route('notifications.index'));
    }
}
