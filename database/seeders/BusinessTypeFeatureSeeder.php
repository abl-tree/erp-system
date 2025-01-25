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
        $cleaning = BusinessType::where('name', 'Cleaning Business')->first();
        $landscaping = BusinessType::where('name', 'Landscaping')->first();
        $janitorial = BusinessType::where('name', 'Janitorial')->first();
        $repairmen = BusinessType::where('name', 'Repairmen')->first();
        $moving = BusinessType::where('name', 'Moving Company')->first();
        $pm = BusinessType::where('name', 'Property Managers')->first();
        $tg = BusinessType::where('name', 'Tour Guide')->first();
        $photoghraphy = BusinessType::where('name', 'Photography')->first();
        $ec = BusinessType::where('name', 'Event Coordinators')->first();
        $cb = BusinessType::where('name', 'Cleaning Business')->first();
        $sf = BusinessType::where('name', 'Shipping/Freight')->first();
        $bs = BusinessType::where('name', 'Beauty Salons')->first();
        $fs = BusinessType::where('name', 'Financial Services')->first();
        $ls = BusinessType::where('name', 'Legal services')->first();

        // Get business features
        $customer = BusinessFeatures::where('name', 'Customer Onboarding')->first();
        $jobsched = BusinessFeatures::where('name', 'Job scheduling and assignment')->first();
        $app = BusinessFeatures::where('name', 'Appointment')->first();
        $booking = BusinessFeatures::where('name', 'Online booking and Appointment')->first();
        $invoicing = BusinessFeatures::where('name', 'Invoicing and payment processing')->first();
        $tracking = BusinessFeatures::where('name', 'Job tracking and status updates')->first();
        $client = BusinessFeatures::where('name', 'Client and contact management(CRM)')->first();
        $task = BusinessFeatures::where('name', 'Task management and team collaboration')->first();
        $docs = BusinessFeatures::where('name', 'Document and file management')->first();
        $gps = BusinessFeatures::where('name', 'GPS and route optimization')->first();
        $cost = BusinessFeatures::where('name', 'Job cost estimation + Proposal Mgt.')->first();

        // Attach features to business types
        $cleaning->businessFeatures()->attach([$customer->id, $jobsched->id, $invoicing->id, $client->id, $task->id]);
        $landscaping->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $invoicing->id, $client->id, $gps->id, $cost->id]);
        $janitorial->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $invoicing->id, $client->id]);
        $repairmen->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $tracking->id, $client->id, $task->id, $gps->id, $cost->id]);
        $moving->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $invoicing->id, $tracking->id, $client->id, $cost->id]);
        $pm->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $invoicing->id, $tracking->id, $client->id, $task->id, $docs->id]);
        $tg->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $invoicing->id, $client->id]);
        $photoghraphy->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $invoicing->id, $client->id, $task->id, $docs->id, $cost->id]);
        $ec->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $tracking->id, $client->id, $task->id, $docs->id]);
        $cb->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $client->id]);
        $sf->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $tracking->id, $client->id, $gps->id]);
        $bs->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $client->id]);
        $fs->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $client->id, $docs->id]);
        $ls->businessFeatures()->attach([$customer->id, $jobsched->id, $app->id, $booking->id, $invoicing->id, $client->id, $docs->id]);
    }
}
