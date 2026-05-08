<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'name' => 'Imóvel 1',
            'address' => 'Rua Teste, 123',
            'city' => 'Teste',
            'postal_code' => '12345-678',
            'owner_user_id' => 1,
            'rating' => 4.5,
        ]);

        Property::create([
            'name' => 'Imóvel 2',
            'address' => 'Rua Teste, 456',
            'city' => 'Teste',
            'postal_code' => '12345-678',
            'owner_user_id' => 2,
            'rating' => 1.5,
        ]);

        Property::create([
            'name' => 'Pra Simular',
            'address' => 'Rua Simulação, 456',
            'city' => 'Teste',
            'postal_code' => '12334145-678',
            'owner_user_id' => 10,
            'rating' => 5.0,
        ]);
    }
}
