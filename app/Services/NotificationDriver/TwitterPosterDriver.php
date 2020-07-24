<?php

namespace App\Services\NotificationDriver;

use Illuminate\Notifications\Notification;

class TwitterPosterDriver
{
    public function send($notifiable, Notification $notification)
    {
        $notification->toTwitter($notifiable);
    }
}
