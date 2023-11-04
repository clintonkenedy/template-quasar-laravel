<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $user = User::create([
            'name' => 'password',
            'email' => 'password@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('Administrador');
    }
}
