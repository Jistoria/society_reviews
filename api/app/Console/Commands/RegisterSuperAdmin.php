<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class RegisterSuperAdmin extends Command
{
    protected $signature = 'register:super-admin';
    protected $description = 'Register a new user with the super_admin role';

    public function handle()
    {

        // Verificar si el usuario ya existe


        // Crear el usuario
        $user = User::create([
            'name' => 'Societyr',
            'email' => 'societyreviewers@gmail.com',
            'password' => bcrypt('societyr1207'),
            'color' => 'rgb(52, 143, 213)'
            // Ajusta la contraseña según tus necesidades
        ]);

        // Asignar el rol super_admin al usuario
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        if ($superAdminRole) {
            $user->assignRole($superAdminRole);
            $this->info("Usuario registrado como super_admin correctamente.");
        } else {
            $this->error('No se pudo encontrar el rol super_admin.');
        }
    }
}
