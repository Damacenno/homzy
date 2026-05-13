<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'can_be_found' => false,
            'profile_image_path' => null,
            'brief_description' => null,
            'skills' => null,
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'Profissional de limpeza',
            'email' => 'blackeyedpeas@eu.com',
            'user_type_id' => 2,
            'can_be_found' => true,
            'profile_image_path' => 'https://th.bing.com/th/id/R.8a9593a717bb8d769cfa5783a5da0903?rik=JAsQO163dI%2bVvw&pid=ImgRaw&r=0',
            'brief_description' => 'Eu sou muito bom em limpeza po olha minha foto ai',
            'skills' => json_encode([["Name" => "Limpeza de Casa", "Level" => "5"], ["Name" => "Limpeza de Escritório", "Level" => "3"]]),
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'Profissional (não tão bom) de limpeza',
            'email' => 'quandoprecisar@eu.com',
            'can_be_found' => true,
            'user_type_id' => 2,
            'profile_image_path' => 'https://th.bing.com/th/id/R.8a9593a717bb8d769cfa5783a5da0903?rik=JAsQO163dI%2bVvw&pid=ImgRaw&r=0',
            'brief_description' => 'Eu sou muito bom em limpeza po olha minha foto ai',
            'skills' => json_encode([["Name" => "Limpeza de Geladeira", "Level" => "5"], ["Name" => "Forte", "Level" => "3"]]),
            'password' => bcrypt('admin'),
        ]);



        $this->call([
            PropertySeeder::class,
            CleaningJobSeeder::class,
            JobStatusSeeder::class,
            UserTypeSeeder::class,
            JobApplicationSeeder::class
        ]);
    }
}
