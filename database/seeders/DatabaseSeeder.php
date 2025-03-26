<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(WorldTableSeeder::class);

        // Run individual seeders
        $this->call([
            BusinessTypeSeeder::class,
            BusinessFeatureSeeder::class,
            BusinessTypeFeatureSeeder::class, // Pivot table seeder
            JobRolesSeeder::class,
            DepartmentSeeder::class,
            EmploymentTypeSeeder::class,
            AttendanceShiftSeeder::class,
            RoleSeeder::class,
            SubRoleSeeder::class,
            UserStatusSeeder::class,
        ]);
    }
}
