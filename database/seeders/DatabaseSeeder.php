<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       
        $this->call([
            RoleSeeder::class,
            ResidenciasSeeder::class,
            AptosSeeder::class,
            BecadosNacionalesSeeder::class,
            BecadosExtranjerosSeeder::class,
            
        ]);

         User::factory()->create([
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'password'=> bcrypt('12345678')
        ])->assignRole('Admin');

        User::factory()->create([
            'name' => 'Especialista',
            'email' => 'especialista@gmail.com',
            'password'=> bcrypt('12345678')
        ])->assignRole('Especialista');

    }
}
