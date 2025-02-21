<?php

namespace Database\Seeders;

use App\Models\JobRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobRole::create([
            'name' => 'Practical Troubleshooter'
        ]);

        JobRole::create([
            'name' => 'Reliable Fixer'
        ]);

        JobRole::create([
            'name' => 'Skilled Technician'
        ]);
    }
}
