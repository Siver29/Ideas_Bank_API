<?php

namespace Tests\Feature;

use App\Enums\CapitalTier;
use App\Models\City;
use App\Models\Governorate;
use App\Models\InvestmentCategory;
use App\Models\InvestmentProject;
use App\Models\Machinery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * The four expected investment categories are seeded.
     */
    public function test_four_investment_categories_are_seeded(): void
    {
        $slugs = InvestmentCategory::pluck('slug')->all();

        $this->assertCount(4, $slugs);
        $this->assertEqualsCanonicalizing(
            ['technology', 'agriculture', 'industry', 'commerce'],
            $slugs
        );
    }

    /**
     * The three capital tiers are available.
     */
    public function test_capital_tiers_are_defined(): void
    {
        $tiers = array_map(fn (CapitalTier $tier) => $tier->value, CapitalTier::cases());

        $this->assertEqualsCanonicalizing(['small', 'medium', 'large'], $tiers);
    }

    /**
     * Project tier values are valid enum members.
     */
    public function test_project_capital_tier_is_valid_enum(): void
    {
        $tiers = InvestmentProject::pluck('capital_tier')->unique();

        foreach ($tiers as $tier) {
            $this->assertInstanceOf(CapitalTier::class, $tier);
        }
    }

    /**
     * Every project belongs to a category, governorate, and city.
     */
    public function test_project_relationships_resolve(): void
    {
        $project = InvestmentProject::with(['investmentCategory', 'governorate', 'city'])->first();

        $this->assertNotNull($project);
        $this->assertInstanceOf(InvestmentCategory::class, $project->investmentCategory);
        $this->assertInstanceOf(Governorate::class, $project->governorate);
        $this->assertInstanceOf(City::class, $project->city);
    }

    /**
     * A project's city belongs to its governorate (data integrity).
     */
    public function test_project_city_belongs_to_its_governorate(): void
    {
        foreach (InvestmentProject::with(['governorate', 'city'])->get() as $project) {
            $this->assertEquals(
                $project->governorate_id,
                $project->city->governorate_id,
                "City {$project->city->name_en} does not belong to the project's governorate."
            );
        }
    }

    /**
     * Projects have machinery relationships through the pivot with quantity.
     */
    public function test_project_machinery_pivot_has_quantity(): void
    {
        $project = InvestmentProject::with('machinery')->first();

        $this->assertTrue($project->machinery->isNotEmpty());

        $first = $project->machinery->first();

        $this->assertInstanceOf(Machinery::class, $first);
        $this->assertArrayHasKey('quantity', $first->pivot->getAttributes());
    }

    /**
     * Expected profit max is always greater than or equal to min.
     */
    public function test_expected_profit_max_is_at_least_min(): void
    {
        foreach (InvestmentProject::all() as $project) {
            $this->assertGreaterThanOrEqual(
                (float) $project->expected_profit_rate_min,
                (float) $project->expected_profit_rate_max,
                "Project {$project->title_en} has invalid profit bounds."
            );
        }
    }

    /**
     * Quick-return and regular projects are both present.
     */
    public function test_quick_and_normal_return_projects_exist(): void
    {
        $this->assertTrue(InvestmentProject::where('is_quick_return', true)->exists());
        $this->assertTrue(InvestmentProject::where('is_quick_return', false)->exists());
    }

    /**
     * At least forty projects are seeded.
     */
    public function test_at_least_forty_projects_are_seeded(): void
    {
        $this->assertGreaterThanOrEqual(40, InvestmentProject::count());
    }

    /**
     * At least 25 cities are seeded across the governorates.
     */
    public function test_at_least_twenty_five_cities_are_seeded(): void
    {
        $this->assertGreaterThanOrEqual(25, City::count());
    }

    /**
     * Every project has at least one machinery requirement.
     */
    public function test_every_project_has_machinery(): void
    {
        foreach (InvestmentProject::withCount('machinery')->get() as $project) {
            $this->assertGreaterThan(0, $project->machinery_count, "Project {$project->title_en} has no machinery.");
        }
    }
}
