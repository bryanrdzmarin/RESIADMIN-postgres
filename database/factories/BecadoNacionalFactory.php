<?php

namespace Database\Factories;

use App\Models\Becado;
use App\Models\BecadoNacional;
use App\Models\Residencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BecadoNacionalFactory extends Factory
{
     protected $model = BecadoNacional::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        
        $residenciaConAptoDisponible = Residencia::whereHas('aptos', function($query) {
            $query->whereRaw('(SELECT COUNT(*) FROM becados WHERE aptos_id = aptos.id) < aptos.capacidad');
         })->with(['aptos' => function($query) {
            $query->whereRaw('(SELECT COUNT(*) FROM becados WHERE aptos_id = aptos.id) < aptos.capacidad')
                ->inRandomOrder();
        }])->inRandomOrder()->first();
        $becado = Becado::create([
            'ci' => $this->faker->unique()->numerify('###########'),
            'nombre' => $this->faker->name(),
            'fecha_nacimiento' => $this->faker->date(),
            'year_carrera' => $this->faker->randomElement(['primero', 'segundo', 'tercero', 'cuarto']),
            'carrera' => $this->faker->randomElement([
            'Ingeniería Civil',
            'Ingeniería Mecánica',
            'Ingeniería Agrícola',
            'Ingeniería Hidráulica',
            'Licenciatura en Educación Mecánica',
            'Licenciatura en Educación Construcción',
            'Licenciatura en Educación Eléctrica',
            'Licenciatura en Educación Agropecuaria',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Licenciatura en Educación Español-Literatura',
            'Licenciatura en Educación Artística',
            'Licenciatura en Educación: Marxismo Leninismo e Historia',
            'Lic. en Educación Logopedia',
            'Lic. en Educación Especial',
            'Lic. en Educación Preescolar',
            'Lic. en Educación Primaria',
            'Lic. en Educación Biología',
            'Lic. en Educación Geografía',
            'Lic. en Educación Química',
            'Agronomía',
            'Ingeniería en Procesos Agroindustriales',
            'Medicina Veterinaria',
            'Licenciatura en Cultura Física',
            'Técnico Superior en Entrenamiento Deportivo',
            'Ingeniería Informática',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Contabilidad y Finanzas',
            'Turismo',
            'Economía',
            'Técnico Superior en Asistencia Turística',
        ]),
            'origen' => 'nacional', 
            'residencias_id' => $residenciaConAptoDisponible ? $residenciaConAptoDisponible->id : null,
            'aptos_id' => $residenciaConAptoDisponible ? $residenciaConAptoDisponible->aptos->first()->id : null,
            'evaluacion_jefe_residencia' => $this->faker->numberBetween(2, 5),
            'evaluacion_jefe_apto' => $this->faker->numberBetween(2, 5),
            'evaluacion_profesor' => $this->faker->numberBetween(2, 5),


            
        ]);

        $becado->evaluarNacionales();
        // Luego crea el becado nacional
        return [
            'direccion' => $this->faker->address(),
            'becados_ci' => $becado->ci, // Usa el CI recién creado
        ];

       
        
    }
}
