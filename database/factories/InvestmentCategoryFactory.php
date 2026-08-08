<?php

namespace Database\Factories;

use App\Models\InvestmentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<InvestmentCategory>
 */
class InvestmentCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();

        return [
            'name_en' => ucfirst($name),
            'name_ar' => fake()->unique()->word(),
            'slug' => Str::slug($name),
            'description_en' => fake()->sentence(),
            'description_ar' => fake()->sentence(),
            'icon' => null,
            'is_active' => true,
        ];
    }
}
