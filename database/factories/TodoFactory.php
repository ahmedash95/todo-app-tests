<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'status' => 'pending',
        'user_id' => factory(\App\User::class)->create()->id,
        'created_at' => now(),
    ];
});
