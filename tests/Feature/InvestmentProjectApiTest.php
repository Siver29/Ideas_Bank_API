<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Governorate;
use App\Models\InvestmentCategory;
use App\Models\InvestmentProject;
use App\Models\Machinery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvestmentProjectApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * The project list returns all active projects and is not paginated.
     */
    public function test_project_list_returns_all_active_projects_unpaginated(): void
    {
        $response = $this->getJson('/api/v1/investment-projects');

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonMissingPath('meta');

        $activeCount = InvestmentProject::where('is_active', true)->count();
        $this->assertCount($activeCount, $response->json('data'));
    }

    /**
     * The project list rejects any query parameter with a 422.
     */
    public function test_project_list_rejects_all_query_parameters(): void
    {
        foreach (['search' => 'tech', 'category_id' => 1, 'page' => 2, 'sort' => 'newest'] as $param => $value) {
            $response = $this->getJson("/api/v1/investment-projects?{$param}=".urlencode((string) $value));

            $response->assertStatus(422)
                ->assertJsonPath('success', false)
                ->assertJsonStructure(['errors', 'message']);
        }
    }

    /**
     * Inactive projects are hidden from the public list.
     */
    public function test_inactive_projects_are_hidden(): void
    {
        $inactive = InvestmentProject::factory()->create(['is_active' => false]);

        $response = $this->getJson('/api/v1/investment-projects');

        $response->assertOk();
        $ids = collect($response->json('data'))->pluck('id');
        $this->assertNotContains($inactive->id, $ids);
    }

    /**
     * The project detail contains machinery, location, and bilingual fields.
     */
    public function test_project_detail_contains_machinery_location_and_bilingual_fields(): void
    {
        $project = InvestmentProject::with('machinery')->first();

        $response = $this->getJson("/api/v1/investment-projects/{$project->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $project->id)
            ->assertJsonStructure([
                'data' => [
                    'title_en',
                    'title_ar',
                    'latitude',
                    'longitude',
                    'machinery',
                ],
            ]);

        $this->assertNotEmpty($response->json('data.machinery'));
    }

    /**
     * An inactive project detail returns a 404.
     */
    public function test_inactive_project_detail_returns_not_found(): void
    {
        $inactive = InvestmentProject::factory()->create(['is_active' => false]);

        $this->getJson("/api/v1/investment-projects/{$inactive->id}")
            ->assertStatus(404)
            ->assertJsonPath('success', false);
    }

    /**
     * The categories endpoint lists only active categories.
     */
    public function test_categories_list_only_active(): void
    {
        InvestmentCategory::factory()->create(['is_active' => false]);

        $response = $this->getJson('/api/v1/investment-categories');

        $response->assertOk()
            ->assertJsonPath('success', true);

        $ids = collect($response->json('data'))->pluck('id');
        $this->assertNotContains(
            InvestmentCategory::where('is_active', false)->first()->id,
            $ids
        );
    }

    /**
     * The cities endpoint lists only active cities.
     */
    public function test_cities_list_only_active(): void
    {
        City::factory()->create(['is_active' => false]);

        $response = $this->getJson('/api/v1/cities');

        $response->assertOk()
            ->assertJsonPath('success', true);

        $ids = collect($response->json('data'))->pluck('id');
        $this->assertNotContains(
            City::where('is_active', false)->first()->id,
            $ids
        );
    }

    /**
     * The machinery catalogue can be listed and viewed.
     */
    public function test_machinery_can_be_listed_and_viewed(): void
    {
        $machinery = Machinery::first();

        $this->getJson('/api/v1/machinery')
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->getJson("/api/v1/machinery/{$machinery->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $machinery->id)
            ->assertJsonStructure(['data' => ['name_en', 'name_ar']]);
    }

    /**
     * Governorate cities lists only active cities belonging to the governorate.
     */
    public function test_governorate_cities_lists_active_cities(): void
    {
        $governorate = Governorate::first();

        $response = $this->getJson("/api/v1/governorates/{$governorate->id}/cities");

        $response->assertOk()
            ->assertJsonPath('success', true);

        $ids = collect($response->json('data'))->pluck('governorate_id')->unique();
        $this->assertEquals([$governorate->id], $ids->all());
    }
}
