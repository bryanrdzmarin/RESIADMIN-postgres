<?php

namespace Database\Seeders;

use App\Models\BecadoNacional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BecadosNacionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BecadoNacional::factory()->count(50)->create();

    }
}
