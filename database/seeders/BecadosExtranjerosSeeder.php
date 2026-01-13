<?php

namespace Database\Seeders;

use App\Models\BecadoExtranjero;;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BecadosExtranjerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $becados = BecadoExtranjero::factory()->count(50)->create();

        foreach ($becados as $becadoExtranjero) {
            $becadoExtranjero->becado->evaluarExtranjeros();
        }



    }
}
