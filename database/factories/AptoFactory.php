<?php

namespace Database\Factories;

use App\Models\Apto;
use App\Models\Residencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aptos>
 */
class AptoFactory extends Factory
{
     protected $model = Apto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'residencias_id' => Residencia::all()->random()->id,
            'numero' => $this->faker->numberBetween(1, 50),
            'capacidad' => $this->faker->numberBetween(1, 6),
            'jefe_apartamento' => $this->faker->name,
            'profesor_asignado' => $this->faker->name,
        ];
    }
}
