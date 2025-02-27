<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['name' => 'Aceh'],
            ['name' => 'North Sumatra'],
            ['name' => 'West Sumatra'],
            ['name' => 'Riau'],
            ['name' => 'Jambi'],
            ['name' => 'South Sumatra'],
            ['name' => 'Bengkulu'],
            ['name' => 'Lampung'],
            ['name' => 'Bangka Belitung'],
            ['name' => 'Riau Islands'],
            ['name' => 'Jakarta'],
            ['name' => 'West Java'],
            ['name' => 'Central Java'],
            ['name' => 'Yogyakarta'],
            ['name' => 'East Java'],
            ['name' => 'Banten'],
            ['name' => 'Bali'],
            ['name' => 'West Nusa Tenggara'],
            ['name' => 'East Nusa Tenggara'],
            ['name' => 'West Kalimantan'],
            ['name' => 'Central Kalimantan'],
            ['name' => 'South Kalimantan'],
            ['name' => 'East Kalimantan'],
            ['name' => 'North Kalimantan'],
            ['name' => 'North Sulawesi'],
            ['name' => 'Central Sulawesi'],
            ['name' => 'South Sulawesi'],
            ['name' => 'Southeast Sulawesi'],
            ['name' => 'Gorontalo'],
            ['name' => 'West Sulawesi'],
            ['name' => 'Maluku'],
            ['name' => 'North Maluku'],
            ['name' => 'West Papua'],
            ['name' => 'Papua'],
            ['name' => 'South Papua'],
            ['name' => 'Central Papua'],
            ['name' => 'Highland Papua'],
            ['name' => 'Southwest Papua'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
