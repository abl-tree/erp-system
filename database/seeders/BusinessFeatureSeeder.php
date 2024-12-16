<?php

namespace Database\Seeders;

use App\Models\BusinessFeatures;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessFeatures::create([
            'name' => 'Outdoor Seating',
            'slug' => 'Outdoor Seating'
        ]);

        BusinessFeatures::create([
            'name' => 'Free Wi-Fi',
            'slug' => 'Free Wi-Fi'
        ]);

        BusinessFeatures::create([
            'name' => '24/7 Service',
            'slug' => '24/7 Service'
        ]);
    }
}
