<?php

namespace Database\Factories;

use App\Models\Pass;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PassFactory extends Factory
{
    protected $model = Pass::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'platform' => $this->faker->word,
            'email_username' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
        ];
    }
}
