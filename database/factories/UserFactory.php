<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'default user ',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'), // password
        ];
    }

}
