<?php

namespace Database\Seeders;

use App\Models\Residencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Residencia::factory()->count(100)->create();

    }
}
