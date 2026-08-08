<?php

namespace Database\Seeders;

use App\Models\InvestmentCategory;
use Illuminate\Database\Seeder;

class InvestmentCategorySeeder extends Seeder
{
    /**
     * Seed the four investment categories.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Technology',
                'name_ar' => 'التكنولوجيا',
                'slug' => 'technology',
                'description_en' => 'Software, digital services, and technology-driven ventures.',
                'description_ar' => 'البرمجيات والخدمات الرقمية والمشاريع التقنية.',
                'icon' => 'monitor',
            ],
            [
                'name_en' => 'Agriculture',
                'name_ar' => 'الزراعة',
                'slug' => 'agriculture',
                'description_en' => 'Farming, irrigation, crops, and agri-food ventures.',
                'description_ar' => 'الزراعة والري والمحاصيل والمشاريع الغذائية.',
                'icon' => 'sprout',
            ],
            [
                'name_en' => 'Industry',
                'name_ar' => 'الصناعة',
                'slug' => 'industry',
                'description_en' => 'Manufacturing, packaging, and production ventures.',
                'description_ar' => 'التصنيع والتعبئة والتغليف ومشاريع الإنتاج.',
                'icon' => 'factory',
            ],
            [
                'name_en' => 'Commerce',
                'name_ar' => 'التجارة',
                'slug' => 'commerce',
                'description_en' => 'Trade, distribution, retail, and logistics ventures.',
                'description_ar' => 'التجارة والتوزيع والتجزئة والخدمات اللوجستية.',
                'icon' => 'shopping-cart',
            ],
        ];

        foreach ($categories as $category) {
            InvestmentCategory::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
