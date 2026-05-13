<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobApplication;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplication::create([
            'cleaner_id' => 2,
            'job_id' => 1,
            'application_type' => 'cleaner',
            'status' => 'pending',
            'message' => 'Break it down, back it up'
        ]);

        JobApplication::create([
            'cleaner_id' => 3,
            'job_id' => 1,
            'application_type' => 'cleaner',
            'status' => 'pending',
            'message' => 'For what it is'
        ]);
    }
}
