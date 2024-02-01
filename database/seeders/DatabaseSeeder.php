<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visitante;
use App\Models\Historial;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $visitantes = Visitante::factory(10)->create();

        $historials = Historial::factory(20)->create();
        // \App\Models\User::factory()->create([

        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
