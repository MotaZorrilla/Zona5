<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 year'),
            'end_time' => $this->faker->dateTimeBetween('+1 year', '+2 years'),
            'location' => $this->faker->address(),
            'type' => $this->faker->randomElement(['event', 'conference', 'meeting', 'workshop', 'tenida']),
            'is_public' => $this->faker->boolean(),
            'created_by' => User::factory(),
        ];
    }
}