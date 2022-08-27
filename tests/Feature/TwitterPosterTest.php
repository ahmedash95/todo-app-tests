<?php

namespace Tests\Feature;

use App\Notifications\TodoPostToTwitter;
use App\Services\TwitterPoster;
use App\Social;
use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwitterPosterTest extends TestCase
{

    use RefreshDatabase;

    public function test_post_to_twitter_is_being_called()
    {
        $this->mock(TwitterPoster::class)->shouldReceive('forUser->post')->once();

        $todo = Todo::factory()->create();
        $todo->user->notify(new TodoPostToTwitter($todo));
    }
}
