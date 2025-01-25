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
            'name' => 'Customer Onboarding'
        ]);

        BusinessFeatures::create([
            'name' => 'Job scheduling and assignment'
        ]);

        BusinessFeatures::create([
            'name' => 'Appointment'
        ]);

        BusinessFeatures::create([
            'name' => 'Online booking and Appointment'
        ]);

        BusinessFeatures::create([
            'name' => 'Invoicing and payment processing'
        ]);

        BusinessFeatures::create([
            'name' => 'Job tracking and status updates'
        ]);

        BusinessFeatures::create([
            'name' => 'Client and contact management(CRM)'
        ]);

        BusinessFeatures::create([
            'name' => 'Task management and team collaboration'
        ]);

        BusinessFeatures::create([
            'name' => 'Document and file management'
        ]);

        BusinessFeatures::create([
            'name' => 'GPS and route optimization'
        ]);

        BusinessFeatures::create([
            'name' => 'Job cost estimation + Proposal Mgt.'
        ]);
    }
}
