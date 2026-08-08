<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Seed a set of Syrian cities (at least 25) across the governorates.
     */
    public function run(): void
    {
        $cities = [
            'DM' => [
                ['name_en' => 'Damascus', 'name_ar' => 'دمشق'],
                ['name_en' => 'Al-Midan', 'name_ar' => 'الميدان'],
                ['name_en' => 'Barzeh', 'name_ar' => 'برزة'],
            ],
            'RD' => [
                ['name_en' => 'Douma', 'name_ar' => 'دوما'],
                ['name_en' => 'Darayya', 'name_ar' => 'داريا'],
                ['name_en' => 'Jaramana', 'name_ar' => 'جرمانا'],
            ],
            'AL' => [
                ['name_en' => 'Aleppo', 'name_ar' => 'حلب'],
                ['name_en' => 'Manbij', 'name_ar' => 'منبج'],
                ['name_en' => 'Al-Bab', 'name_ar' => 'الباب'],
            ],
            'HM' => [
                ['name_en' => 'Homs', 'name_ar' => 'حمص'],
                ['name_en' => 'Al-Qusayr', 'name_ar' => 'القصير'],
                ['name_en' => 'Taldou', 'name_ar' => 'تلدو'],
            ],
            'HA' => [
                ['name_en' => 'Hama', 'name_ar' => 'حماة'],
                ['name_en' => 'Masyaf', 'name_ar' => 'مصياف'],
                ['name_en' => 'Salamiyah', 'name_ar' => 'السلمية'],
            ],
            'LA' => [
                ['name_en' => 'Latakia', 'name_ar' => 'اللاذقية'],
                ['name_en' => 'Jableh', 'name_ar' => 'جبلة'],
                ['name_en' => 'Al-Haffah', 'name_ar' => 'الحفة'],
            ],
            'TA' => [
                ['name_en' => 'Tartus', 'name_ar' => 'طرطوس'],
                ['name_en' => 'Baniyas', 'name_ar' => 'بانياس'],
                ['name_en' => 'Safita', 'name_ar' => 'صافيتا'],
            ],
            'DR' => [
                ['name_en' => 'Daraa', 'name_ar' => 'درعا'],
                ['name_en' => 'Nawa', 'name_ar' => 'نوى'],
                ['name_en' => 'Izra', 'name_ar' => 'إزرع'],
            ],
            'SW' => [
                ['name_en' => 'As-Suwayda', 'name_ar' => 'السويداء'],
                ['name_en' => 'Shahba', 'name_ar' => 'شهبا'],
                ['name_en' => 'Salkhad', 'name_ar' => 'صلخد'],
            ],
            'QU' => [
                ['name_en' => 'Quneitra', 'name_ar' => 'القنيطرة'],
                ['name_en' => 'Khan Arnabah', 'name_ar' => 'خان أرنبة'],
            ],
            'ID' => [
                ['name_en' => 'Idlib', 'name_ar' => 'إدلب'],
                ['name_en' => 'Maarat al-Numan', 'name_ar' => 'معرة النعمان'],
                ['name_en' => 'Jisr al-Shughur', 'name_ar' => 'جسر الشغور'],
            ],
            'DZ' => [
                ['name_en' => 'Deir ez-Zor', 'name_ar' => 'دير الزور'],
                ['name_en' => 'Al-Mayadin', 'name_ar' => 'الميادين'],
            ],
            'RA' => [
                ['name_en' => 'Raqqa', 'name_ar' => 'الرقة'],
                ['name_en' => 'Al-Thawrah', 'name_ar' => 'الطبقة'],
            ],
            'HS' => [
                ['name_en' => 'Al-Hasakah', 'name_ar' => 'الحسكة'],
                ['name_en' => 'Qamishli', 'name_ar' => 'القامشلي'],
                ['name_en' => 'Ras al-Ayn', 'name_ar' => 'رأس العين'],
            ],
        ];

        foreach ($cities as $code => $cityList) {
            $governorate = Governorate::where('code', $code)->first();

            if ($governorate === null) {
                continue;
            }

            foreach ($cityList as $city) {
                City::updateOrCreate(
                    ['governorate_id' => $governorate->id, 'name_en' => $city['name_en']],
                    ['name_ar' => $city['name_ar']]
                );
            }
        }
    }
}
