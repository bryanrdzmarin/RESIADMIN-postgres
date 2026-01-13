<?php

namespace Database\Seeders;

use App\Models\Apto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AptosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apto::factory()->count(100)->create();

    }
}
