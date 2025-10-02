<?php

namespace Database\Factories;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Forum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'is_active' => $this->faker->boolean,
            'is_pinned' => $this->faker->boolean,
            'order' => $this->faker->numberBetween(0, 100),
            'created_by' => User::factory(),
            'posts_count' => $this->faker->numberBetween(0, 1000),
            'last_activity_at' => $this->faker->dateTimeThisMonth(),
            'color' => $this->faker->hexColor,
            'icon' => $this->faker->word,
            'views_count' => $this->faker->numberBetween(0, 10000),
            'is_featured' => $this->faker->boolean,
            'excerpt' => $this->faker->sentence,
        ];
    }
}
