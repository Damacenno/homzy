<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::create([
            'key' => 'ADMIN_ACCOUNT',
            'name' => 'Admin'
        ]);

        UserType::create([
            'key' => 'PROFESSIONAL_CLEANER',
            'name' => 'Profissional de Limpeza'
        ]);
    }
}
