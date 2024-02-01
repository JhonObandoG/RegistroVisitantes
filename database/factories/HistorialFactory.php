<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Historial>
 */
class HistorialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $horaIngreso = $this->faker->dateTimeThisMonth();
        $horaSalida = $this->faker->dateTimeInInterval($horaIngreso, '+6 hours');

        return [
            "nombre" => $this->faker->firstName,
            "apellido" => $this->faker->lastName,
            "documento" => $this->faker->numberBetween(1000000000, 9999999999),
            "telefono" => $this->faker->phoneNumber,
            "oficina" => $this->faker->randomElement(['Valencia_Producciones', 'Stargate', 'SMARTFILMS', 'Visual_Music', 'Mauricio_Navas', 'Fundacion_Amados']),
            "fecha_ingreso" => $horaIngreso->format('Y-m-d'),
            "hora_ingreso" => $horaIngreso->format('H:i:s'),
            "a_quien_visita" => $this->faker->name,
            "motivo" => $this->faker->sentence,
            "hora_salida" => $horaSalida->format('H:i:s'),
        ];
    }
}
