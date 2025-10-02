<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseSession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_time' => $this->faker->dateTimeThisMonth(),
            'end_time' => $this->faker->dateTimeThisMonth(),
            'location' => $this->faker->address,
            'type' => $this->faker->randomElement(['synchronous', 'asynchronous']),
            'instructor_name' => $this->faker->name,
            'instructor_role' => $this->faker->jobTitle,
            'instructor_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['live', 'upcoming', 'closed']),
            'link' => $this->faker->url,
        ];
    }
}
