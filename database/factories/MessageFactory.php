<?php

namespace Database\Factories;

use App\Models\User;
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
        $sender = User::inRandomOrder()->first() ?? User::factory()->create();
        $recipient = User::where('id', '!=', $sender->id)->inRandomOrder()->first() ?? User::factory()->create();

        return [
            'sender_name' => $sender->name,
            'sender_email' => $sender->email,
            'subject' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => $this->faker->randomElement(['unread', 'read', 'archived']),
            'read_at' => $this->faker->optional()->dateTime(),
            'archived_at' => $this->faker->optional()->dateTime(),
        ];
    }

    /**
     * Indicate that the message is unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'unread',
            'read_at' => null,
        ]);
    }

    /**
     * Indicate that the message is read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'read',
            'read_at' => now(),
        ]);
    }

    /**
     * Indicate that the message is archived.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'archived',
            'archived_at' => now(),
        ]);
    }
}
