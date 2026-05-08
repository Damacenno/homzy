<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\JobStatus;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobStatus::create([
            'key' => 'PENDING',
            'name' => 'Pending',
            'color' => '#FFA500',
        ]);

        JobStatus::create([
            'key' => 'IN_PROGRESS',
            'name' => 'In Progress',
            'color' => '#0000FF',
        ]);

        JobStatus::create([
            'key' => 'COMPLETED',
            'name' => 'Completed',
            'color' => '#008000',
        ]);

        JobStatus::create([
            'key' => 'CANCELLED',
            'name' => 'Cancelled',
            'color' => '#FF0000',
        ]);
    }
}
