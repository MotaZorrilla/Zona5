<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use App\Enums\NewsStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(3, true),
            'image_path' => $this->faker->imageUrl(),
            'pdf_path' => null,
            'status' => $this->faker->randomElement(NewsStatusEnum::values()),
            'published_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
