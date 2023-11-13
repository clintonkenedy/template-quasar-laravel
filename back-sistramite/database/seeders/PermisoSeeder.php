<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::updateOrCreate(['name' => 'Administrador'], ['name' => 'Administrador', 'guard_name' => 'api']);
        $personal = Role::updateOrCreate(['name' => 'Operador'], ['name' => 'Operador', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'admin-permisos'], [
            'name' => 'admin-permisos',
            'description' => 'Administrar Permisos'
        ])->assignRole([$admin, $personal]);
        Permission::updateOrCreate(['name' => 'admin-roles'], [
            'name' => 'admin-roles',
            'description' => 'Administrar usuarios'
        ])->assignRole([$admin]);
        Permission::updateOrCreate(['name' => 'admin-usuarios'], [
            'name' => 'admin-usuarios',
            'description' => 'Administrar usuarios'
        ])->assignRole([$admin]);
        Permission::updateOrCreate(['name' => 'admin-roles'], [
            'name' => 'admin-roles',
            'description' => 'Administrar usuarios'
        ])->assignRole([$admin]);
        $user = User::create([
            'name' => 'password',
            'email' => 'password@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('Administrador');
    }
}
