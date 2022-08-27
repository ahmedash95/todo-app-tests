<?php

namespace Tests\Feature;

use App\Mail\BehindScheduleTodosEmail;
use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BehindScheduleCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_is_emailing_users_for_pending_todos()
    {
        Mail::fake();
        Todo::factory()->create([
            'created_at' => new \DateTime('-1 day'),
        ]);
        $this->artisan('todos:behind-schedule');

        Mail::assertSent(BehindScheduleTodosEmail::class);
    }

    public function test_command_is_not_sending_emails_for_done_todos()
    {
        Mail::fake();
        Todo::factory()->create([
            'status' => Todo::STATUS_DONE,
            'created_at' => new \DateTime('-1 day'),
        ]);
        $this->artisan('todos:behind-schedule');

        Mail::assertNothingSent();
    }
}
