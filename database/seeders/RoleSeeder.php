<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1=Role::create(['name'=> 'Admin']);
        $role2=Role::create(['name'=> 'Especialista']);

        // Permisos para el módulo de residencias
        Permission::create(['name' => 'admin.residencias.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.aptosAsociados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.residencias.destroyMultiplesAptos'])->syncRoles([$role1, $role2]);


        // Permisos para el módulo de aptos
        Permission::create(['name' => 'admin.aptos.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.indexOcupados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.becadosAsociados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.indexDisponibles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.reasignarBecados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.showCI'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.reubicandoBecado'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.create'])->assignRole($role1, $role2);
        Permission::create(['name' => 'admin.aptos.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.showDisponibles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.showOcupados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.aptos.destroy'])->syncRoles([$role1, $role2]);

        // Permisos para el módulo de becados
        Permission::create(['name' => 'admin.becados.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.indexNacionales'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.indexExtranjeros'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.createApto'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becadosNacionales.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becadosExtranjeros.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.becados.destroyMultiplesBecados'])->syncRoles([$role1, $role2]);

        // Permisos para evaluaciones (becados)
        Permission::create(['name' => 'admin.evaluar.becados.indexbecadosEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.indexbecadosNacionalesEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.indexbecadosExtranjerosEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.showbecadosEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.showbecadosNacionalesEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.showbecadosExtranjerosEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.evaluarBecado'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.storeEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.editarEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.becados.updateEvaluacion'])->syncRoles([$role1, $role2]);

        // Permisos para evaluaciones (aptos)
        Permission::create(['name' => 'admin.evaluar.aptos.indexEvaluacion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.aptos.becadosAsociadosEvalucion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.evaluar.aptos.showAptosEvaluacion'])->syncRoles([$role1, $role2]);


        // Permisos para búsqueda avanzada - residencias
        Permission::create(['name' => 'admin.busqueda.residencias.indexResidencias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.busqueda.residencias.indexResidenciasMostrar'])->syncRoles([$role1, $role2]);

        // Permisos para búsqueda avanzada - aptos
        Permission::create(['name' => 'admin.busqueda.aptos.indexAptos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.busqueda.aptos.indexAptosMostrar'])->syncRoles([$role1, $role2]);

        // Permisos para búsqueda avanzada - becados
        Permission::create(['name' => 'admin.busqueda.becados.indexBecados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.busqueda.becados.indexBecadosMostrar'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.settings.profile'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.settings.password'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.settings.appearance'])->syncRoles([$role1, $role2]);

        // Permisos para gestión de usuarios (solo para $role1)
        Permission::create(['name' => 'admin.usuarios.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.store'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.show'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.update'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.destroy'])->assignRole($role1);


    }
}
