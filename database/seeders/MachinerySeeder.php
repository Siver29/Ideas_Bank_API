<?php

namespace Database\Seeders;

use App\Models\Machinery;
use Illuminate\Database\Seeder;

class MachinerySeeder extends Seeder
{
    /**
     * Seed the machinery equipment catalogue.
     */
    public function run(): void
    {
        $machinery = [
            [
                'name_en' => 'Laptop Computers',
                'name_ar' => 'أجهزة حاسوب محمولة',
                'description_en' => 'Portable computers for software and office work.',
                'description_ar' => 'أجهزة محمولة للعمل البرمجي والمكتبي.',
            ],
            [
                'name_en' => 'Solar Panels',
                'name_ar' => 'ألواح شمسية',
                'description_en' => 'Photovoltaic panels for solar energy generation.',
                'description_ar' => 'ألواح كهروضوئية لتوليد الطاقة الشمسية.',
            ],
            [
                'name_en' => 'Irrigation System',
                'name_ar' => 'نظام ري',
                'description_en' => 'Drip or sprinkler irrigation equipment for farms.',
                'description_ar' => 'معدات ري بالتنقيط أو الرش للمزارع.',
            ],
            [
                'name_en' => 'Packaging Machine',
                'name_ar' => 'آلة تغليف',
                'description_en' => 'Machine for sealing and packaging food products.',
                'description_ar' => 'آلة لإغلاق وتغليف المنتجات الغذائية.',
            ],
            [
                'name_en' => 'Refrigeration Unit',
                'name_ar' => 'وحدة تبريد',
                'description_en' => 'Cooling units for storing fresh or dairy products.',
                'description_ar' => 'وحدات تبريد لحفظ المنتجات الطازجة أو الألبان.',
            ],
            [
                'name_en' => 'Industrial Oven',
                'name_ar' => 'فرن صناعي',
                'description_en' => 'Large oven for bakery and food processing.',
                'description_ar' => 'فرن كبير للمخابز وتصنيع الأغذية.',
            ],
            [
                'name_en' => 'Sewing Machine',
                'name_ar' => 'آلة خياطة',
                'description_en' => 'Machine for textile and garment production.',
                'description_ar' => 'آلة لإنتاج المنسوجات والملابس.',
            ],
            [
                'name_en' => 'Delivery Vehicle',
                'name_ar' => 'مركبة توصيل',
                'description_en' => 'Vehicle for local delivery and distribution.',
                'description_ar' => 'مركبة للتوصيل والتوزيع المحلي.',
            ],
            [
                'name_en' => 'Agricultural Tractor',
                'name_ar' => 'جرار زراعي',
                'description_en' => 'Tractor for tilling and farm operations.',
                'description_ar' => 'جرار للحراثة والعمليات الزراعية.',
            ],
            [
                'name_en' => 'Production Line',
                'name_ar' => 'خط إنتاج',
                'description_en' => 'Complete production line for manufacturing.',
                'description_ar' => 'خط إنتاج متكامل للتصنيع.',
            ],
            [
                'name_en' => 'Water Heater',
                'name_ar' => 'سخان ماء',
                'description_en' => 'Heating equipment for industrial or commercial use.',
                'description_ar' => 'معدات تسخين للاستخدام الصناعي أو التجاري.',
            ],
            [
                'name_en' => 'Storage Racks',
                'name_ar' => 'رفوف تخزين',
                'description_en' => 'Shelving for warehouse and retail storage.',
                'description_ar' => 'أرفف لتخزين المستودعات والمتاجر.',
            ],
        ];

        foreach ($machinery as $item) {
            Machinery::updateOrCreate(['name_en' => $item['name_en']], $item);
        }
    }
}
