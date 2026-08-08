<?php

namespace Database\Factories;

use App\Enums\CapitalTier;
use App\Models\City;
use App\Models\Governorate;
use App\Models\InvestmentCategory;
use App\Models\InvestmentProject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvestmentProject>
 */
class InvestmentProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $governorate = Governorate::factory()->create();
        $city = City::factory()->create(['governorate_id' => $governorate->id]);

        $min = fake()->randomFloat(2, 5, 40);
        $max = $min + fake()->randomFloat(2, 2, 30);

        return [
            'investment_category_id' => InvestmentCategory::factory(),
            'governorate_id' => $governorate->id,
            'city_id' => $city->id,
            'title_en' => fake()->sentence(4),
            'title_ar' => fake()->sentence(4),
            'brief_description_en' => fake()->paragraph(2),
            'brief_description_ar' => fake()->paragraph(2),
            'full_details_en' => fake()->paragraphs(4, true),
            'full_details_ar' => fake()->paragraphs(4, true),
            'required_capital' => fake()->randomFloat(2, 5000, 500000),
            'currency' => 'USD',
            'capital_tier' => fake()->randomElement(CapitalTier::cases()),
            'expected_profit_rate_min' => $min,
            'expected_profit_rate_max' => $max,
            'expected_return_period_months' => fake()->numberBetween(6, 36),
            'location_description_en' => fake()->sentence(),
            'location_description_ar' => fake()->sentence(),
            'latitude' => fake()->latitude(32, 37),
            'longitude' => fake()->longitude(35, 42),
            'is_quick_return' => fake()->boolean(),
            'image_path' => null,
            'is_active' => true,
        ];
    }
}
