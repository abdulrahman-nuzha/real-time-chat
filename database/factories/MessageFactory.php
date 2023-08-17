<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['text', 'image', 'voice', 'video']);
                
        $roomIds = \App\Models\Room::pluck('id')->toArray();

        return [
            'message' => fake()->sentence,
            'room_id' => fake()->randomElement($roomIds),
            'type' => $type,
        ];
    }
}
