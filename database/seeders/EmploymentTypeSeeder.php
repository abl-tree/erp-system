<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmploymentType::create([
            'name' => 'Full-time'
        ]);

        EmploymentType::create([
            'name' => 'Part-time'
        ]);

        EmploymentType::create([
            'name' => 'Contract'
        ]);
    }
}
