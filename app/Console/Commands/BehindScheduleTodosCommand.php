<?php

namespace App\Console\Commands;

use App\Mail\BehindScheduleTodosEmail;
use App\Todo;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BehindScheduleTodosCommand extends Command
{
    protected $signature = 'todos:behind-schedule';

    protected $description = 'Notifies users when they have pending todos behind schedule';

    public function handle()
    {
        User::whereHas('todos', function($q){
           return $q->beforeNow()->pending();
        })
        ->each(function($user){
            Mail::to($user)->send(new BehindScheduleTodosEmail($user->todos));
            $this->info('Notifying user: '.$user->name);
        });
    }
}
