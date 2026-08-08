<?php

namespace Database\Factories;

use App\Models\Machinery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Machinery>
 */
class MachineryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => fake()->unique()->word(),
            'name_ar' => fake()->unique()->word(),
            'description_en' => fake()->sentence(),
            'description_ar' => fake()->sentence(),
        ];
    }
}
