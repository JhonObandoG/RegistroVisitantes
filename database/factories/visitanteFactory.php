<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitante>
 */
class visitanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $oficinas = ['Valencia_Producciones', 'Stargate', 'SMARTFILMS', 'Visual_Music', 'Mauricio_Navas', 'Fundacion_Amados'];

        return [
            "nombre" => $this->faker->firstName,
            "apellido" => $this->faker->lastName,
            "tipo_documento" => $this->faker->randomElement(['CC', 'TI']),

            "documento" => $this->faker->numberBetween(1000000000, 9999999999),
            "telefono" => $this->faker->phoneNumber,
            "oficina" => $this->faker->randomElement($oficinas),
        ];

        
    }
}
