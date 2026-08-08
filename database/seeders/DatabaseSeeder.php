<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with the investment ideas domain.
     */
    public function run(): void
    {
        $this->call([
            GovernorateSeeder::class,
            CitySeeder::class,
            InvestmentCategorySeeder::class,
            MachinerySeeder::class,
            InvestmentProjectSeeder::class,
        ]);
    }
}
