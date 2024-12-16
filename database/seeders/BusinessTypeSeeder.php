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
            'name' => 'Restaurant',
            'slug' => 'Restaurant'
        ]);

        BusinessType::create([
            'name' => 'Hotel',
            'slug' => 'Hotel'
        ]);

        BusinessType::create([
            'name' => 'Cafe',
            'slug' => 'Cafe'
        ]);
    }
}
