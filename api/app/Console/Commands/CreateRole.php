<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    protected $signature = 'create:role {name : The name of the role}';
    protected $description = 'Create a new role';

    public function handle()
    {
        $roleName = $this->argument('name');

        // Verificar si el rol ya existe
        if (Role::where('name', $roleName)->exists()) {
            $this->error('El rol ya existe.');
            return;
        }

        // Crear el rol
        Role::create(['name' => $roleName]);

        $this->info("El rol '$roleName' ha sido creado correctamente.");
    }
}
