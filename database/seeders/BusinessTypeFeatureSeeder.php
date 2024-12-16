<?php

namespace Database\Seeders;

use App\Models\BusinessFeatures;
use App\Models\BusinessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessTypeFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get business types
        $restaurant = BusinessType::where('name', 'Restaurant')->first();
        $hotel = BusinessType::where('name', 'Hotel')->first();

        // Get business features
        $outdoorSeating = BusinessFeatures::where('name', 'Outdoor Seating')->first();
        $freeWiFi = BusinessFeatures::where('name', 'Free Wi-Fi')->first();
        $service24 = BusinessFeatures::where('name', '24/7 Service')->first();

        // Attach features to business types
        $restaurant->businessFeatures()->attach([$outdoorSeating->id, $freeWiFi->id]);
        $hotel->businessFeatures()->attach([$freeWiFi->id, $service24->id]);
    }
}
