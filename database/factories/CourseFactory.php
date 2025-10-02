<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'grade_level' => $this->faker->randomElement(['aprendiz', 'companero', 'maestro']),
            'image_url' => $this->faker->imageUrl(),
            'instructor_name' => $this->faker->name,
            'instructor_role' => $this->faker->jobTitle,
            'instructor_image' => $this->faker->imageUrl(),
            'duration' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['active', 'inactive', 'upcoming']),
            'type' => $this->faker->randomElement(['synchronous', 'asynchronous']),
            'link' => $this->faker->url,
        ];
    }
}
