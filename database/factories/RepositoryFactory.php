<?php

namespace Database\Factories;

use App\Models\Repository;
use App\Models\User;
use App\Enums\GradeLevelEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepositoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Repository::class;

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
            'file_path' => $this->faker->url,
            'file_name' => $this->faker->word . '.' . $this->faker->fileExtension,
            'file_type' => $this->faker->mimeType,
            'file_size' => $this->faker->numberBetween(100, 100000),
            'category' => $this->faker->word,
            'grade_level' => $this->faker->randomElement(GradeLevelEnum::values()),
            'uploaded_by' => User::factory(),
            'uploaded_at' => $this->faker->dateTimeThisMonth(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
