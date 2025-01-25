<?php

namespace Database\Seeders;

use App\Models\BusinessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessType::create([
            'name' => 'Cleaning Business'
        ]);

        BusinessType::create([
            'name' => 'Landscaping'
        ]);

        BusinessType::create([
            'name' => 'Janitorial'
        ]);

        BusinessType::create([
            'name' => 'Repairmen'
        ]);

        BusinessType::create([
            'name' => 'Moving Company'
        ]);

        BusinessType::create([
            'name' => 'Property Managers'
        ]);

        BusinessType::create([
            'name' => 'Tour Guide'
        ]);

        BusinessType::create([
            'name' => 'Photography'
        ]);

        BusinessType::create([
            'name' => 'Event Coordinators'
        ]);

        BusinessType::create([
            'name' => 'Cleaning Business'
        ]);

        BusinessType::create([
            'name' => 'Shipping/Freight'
        ]);

        BusinessType::create([
            'name' => 'Beauty Salons'
        ]);

        BusinessType::create([
            'name' => 'Financial Services'
        ]);

        BusinessType::create([
            'name' => 'Legal services'
        ]);
    }
}
