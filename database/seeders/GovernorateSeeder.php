<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Seed the 14 Syrian governorates.
     */
    public function run(): void
    {
        $governorates = [
            ['name_en' => 'Damascus', 'name_ar' => 'دمشق', 'code' => 'DM'],
            ['name_en' => 'Rif Dimashq', 'name_ar' => 'ريف دمشق', 'code' => 'RD'],
            ['name_en' => 'Aleppo', 'name_ar' => 'حلب', 'code' => 'AL'],
            ['name_en' => 'Homs', 'name_ar' => 'حمص', 'code' => 'HM'],
            ['name_en' => 'Hama', 'name_ar' => 'حماة', 'code' => 'HA'],
            ['name_en' => 'Latakia', 'name_ar' => 'اللاذقية', 'code' => 'LA'],
            ['name_en' => 'Tartus', 'name_ar' => 'طرطوس', 'code' => 'TA'],
            ['name_en' => 'Daraa', 'name_ar' => 'درعا', 'code' => 'DR'],
            ['name_en' => 'As-Suwayda', 'name_ar' => 'السويداء', 'code' => 'SW'],
            ['name_en' => 'Quneitra', 'name_ar' => 'القنيطرة', 'code' => 'QU'],
            ['name_en' => 'Idlib', 'name_ar' => 'إدلب', 'code' => 'ID'],
            ['name_en' => 'Deir ez-Zor', 'name_ar' => 'دير الزور', 'code' => 'DZ'],
            ['name_en' => 'Raqqa', 'name_ar' => 'الرقة', 'code' => 'RA'],
            ['name_en' => 'Al-Hasakah', 'name_ar' => 'الحسكة', 'code' => 'HS'],
        ];

        foreach ($governorates as $governorate) {
            Governorate::updateOrCreate(['code' => $governorate['code']], $governorate);
        }
    }
}
