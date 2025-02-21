<?php

namespace Database\Seeders;

use App\Models\AttendanceShift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttendanceShift::create([
            'name' => 'Morning Shift'
        ]);
        
        AttendanceShift::create([
            'name' => 'Afternoon Shift'
        ]);
        
        AttendanceShift::create([
            'name' => 'Evening Shift'
        ]);
    }
}
