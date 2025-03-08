<?php

namespace Database\Seeders;

use App\Models\SubRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubRole::create([
            'id' => 1,
            'name' => 'Admin',
            'role_id' => 3
        ]);

        SubRole::create([
            'id' => 2,
            'name' => 'Staff',
            'role_id' => 3
        ]);
    }
}
