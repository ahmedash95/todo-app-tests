<?php

namespace App\Notifications;

use App\Services\NotificationDriver\TwitterPosterDriver;
use App\Services\TwitterPoster;
use App\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TodoPostToTwitter extends Notification
{
    use Queueable;

    public $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function via($notifiable)
    {
        return [TwitterPosterDriver::class];
    }

    public function toTwitter($notifiable)
    {
        return TwitterPoster::forUser($notifiable)->post("I've just finished one of my todos: {$this->todo->name}");
    }
}
