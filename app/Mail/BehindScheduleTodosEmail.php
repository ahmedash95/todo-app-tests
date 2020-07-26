<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BehindScheduleTodosEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $todos;

    public function __construct($todos)
    {
        $this->todos = $todos;
    }

    public function build()
    {
        return $this->markdown('emails.behind-schedule-todos', [
            'todos' => $this->todos,
        ]);
    }
}
