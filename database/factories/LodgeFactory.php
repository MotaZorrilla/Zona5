<?php

namespace Database\Factories;

use App\Models\Lodge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LodgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lodge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;
        $number = $this->faker->unique()->numberBetween(1, 500);
        return [
            'name' => $name,
            'slug' => Str::slug($name . '-' . $number),
            'number' => $number,
            'orient' => $this->faker->city,
            'history' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
        ];
    }
}
