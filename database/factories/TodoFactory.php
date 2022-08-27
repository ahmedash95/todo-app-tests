<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory {

    public function definition() {
	return [
	    'name' => $this->faker->words(3, true),
	    'status' => 'pending',
	    'user_id' => User::factory()->create()->id,
	    'created_at' => now(),
	];
    }
}
