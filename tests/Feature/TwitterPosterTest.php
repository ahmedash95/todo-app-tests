<?php

namespace Tests\Feature;

use App\Notifications\TodoPostToTwitter;
use App\Services\TwitterPoster;
use App\Todo;
use Tests\TestCase;

class TwitterPosterTest extends TestCase
{
    public function test_post_to_twitter_is_being_called()
    {
        $this->mock(TwitterPoster::class)->shouldReceive('forUser->post')->once();

        $todo = factory(Todo::class)->create();
        $todo->user->notify(new TodoPostToTwitter($todo));
    }
}
