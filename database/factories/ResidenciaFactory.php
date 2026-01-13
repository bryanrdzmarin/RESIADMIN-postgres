<?php

namespace Database\Factories;

use App\Models\Residencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Residencias>
 */
class ResidenciaFactory extends Factory
{
     protected $model = Residencia::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
            'nombre' => $this->faker->company,
            'cantidad_aptos' => $this->faker->numberBetween(5, 50),
            'jefe_consejo_residencia' => $this->faker->name,
            'profesor_asignado' => $this->faker->name,
        ];
    }
}
