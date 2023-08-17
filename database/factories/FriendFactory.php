<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['approved', 'rejected', 'pending']);

        $userIds = \App\Models\User::pluck('id')->toArray();

        return [
            'user_id_1' => fake()->randomElement($userIds),
            'user_id_2' => fake()->randomElement($userIds),
            'status' => $status,
        ];
    }
}
