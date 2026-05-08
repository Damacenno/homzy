<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CleaningJob;

class CleaningJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CleaningJob::create([
            'property_id' => 1,
            'scheduled_at' => now()->addDays(3),
            'is_completed' => false,
            'status_id' => 1
        ]);

        CleaningJob::create([
            'property_id' => 2,
            'cleaner_user_id' => 2,
            'scheduled_at' => now()->addDays(3),
            'is_completed' => false,
            'status_id' => 1
        ]);

        CleaningJob::create([
            'property_id' => 3,
            'is_completed' => false,
            'status_id' => 1,
            'tasks' => [
                [
                    'task' => 'Limpar cozinha',
                    'importance_level' => 10,
                    'is_required' => true
                ],
                [
                    'task' => 'Limpar casinha do cachorro',
                    'importance_level' => 5,
                    'is_required' => false
                ],
                [
                    'task' => 'Lavar panos de prato',
                    'importance_level' => 3,
                    'is_required' => true
                ]
            ]
        ]);
    }
}
