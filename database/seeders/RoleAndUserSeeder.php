<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear único rol
        $role = Role::create(['name' => 'Gestor RRHH']);
        
        // Crear único usuario
        $user = User::create([
            'name' => 'Gestor RRHH',
            'email' => 'gestor@techsolutions.com',
            'password' => Hash::make('password'),
        ]);
        
        // Asignar rol al usuario
        $user->assignRole($role);
    }
}