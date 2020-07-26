<?php


namespace App\Services;


use App\User;
use DG\Twitter\Twitter;

class TwitterPoster
{
    private $twitter;

    public function forUser(User $user): self
    {
        $config = $user->token('twitter');

        return new self($config['token'], $config['secret']);
    }

    public function __construct($accessToken, $accessTokenSecret)
    {
        $config = config('services.twitter');
        $this->twitter = new Twitter($config['client_id'], $config['client_secret'], $accessToken, $accessTokenSecret);
    }

    public function post($message)
    {
        return $this->twitter->send($message);
    }
}
