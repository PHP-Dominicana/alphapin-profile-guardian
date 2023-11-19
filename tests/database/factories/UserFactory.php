<?php

namespace PHPDominicana\AlphapinProfileGuardian\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardianModel;


class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
			'id' => $this->faker->randomDigit(),
			'name' => $this->faker->name(),
			'email' => $this->faker->email(),
        ];
    }
}

