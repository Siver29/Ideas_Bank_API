<?php

namespace Database\Factories;

use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Governorate>
 */
class GovernorateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => fake()->unique()->city(),
            'name_ar' => fake()->unique()->city(),
            'code' => strtoupper(fake()->unique()->lexify('????')),
            'is_active' => true,
        ];
    }
}
