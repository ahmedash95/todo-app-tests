<?php

namespace Tests\Feature;

use App\Notifications\TodoPostToTwitter;
use App\Todo;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_see_todos_page()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get('/todo')
            ->assertStatus(200);
    }

    public function test_new_user_see_alert_to_connect_to_twitter()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get('/todo')
            ->assertSee('to publish your todos');
    }

    public function test_user_can_add_todo()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post('/todo', [
                'name' => 'simple todo',
            ]);

        $this->assertDatabaseHas('todos', [
            'user_id' => $user->id,
            'name' => 'simple todo',
        ]);
    }

    public function test_todos_page_displays_todos_list()
    {
        $user = factory(User::class)->create();
        $todos = factory(Todo::class, 10)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get('/todo')
            ->assertSee(200)
            ->assertSee($todos->first()->name);
    }

    public function test_user_can_not_see_other_users_todos()
    {
        $user = factory(User::class)->create();
        factory(Todo::class)->create([
            'user_id' => $user->id,
        ]);

        $user2 = factory(User::class)->create();
        $todo = factory(Todo::class)->create([
            'user_id' => $user2->id,
        ]);

        $this->actingAs($user)
            ->get('/todo')
            ->assertSee(200)
            ->assertDontSee($todo->name);
    }

    public function test_user_can_see_done_todos()
    {
        $user = factory(User::class)->create();
        $todo = factory(Todo::class)->create([
            'status' => 'done',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get('/todo')
            ->assertSee(200)
            ->assertSee($todo->name);
    }

    public function tests_user_can_mark_todo_as_done()
    {
        $user = factory(User::class)->create();
        $todo = factory(Todo::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->put('/todo/'.$todo->id)
            ->assertStatus(302);

        $this->assertTrue($todo->fresh()->status == Todo::STATUS_DONE);
    }

    public function tests_user_can_publish_todo_to_twitter_when_mark_as_done()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        $todo = factory(Todo::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->put('/todo/'.$todo->id, [
                'twitter' => true,
            ])
            ->assertStatus(302);

        Notification::assertSentTo($user, TodoPostToTwitter::class);
    }

    public function test_user_can_delete_todo()
    {
        $todo = factory(Todo::class)->create();
        $this->actingAs($todo->user)->delete('/todo/'.$todo->id);

        $this->assertDatabaseCount('todos', 0);
    }
}
