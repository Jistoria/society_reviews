<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class CreateDefaultPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:default-permissions';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default permissions for the application';
    /**
     * Execute the console command.
     */





    public function handle()
    {
        // Lista de permisos predeterminados
        $permissions = [
            'view-dashboard',
            //Permisos para franquicia
            'create-franchise',
            'edit-franchise',
            'delete-franchise',
            //Permisos para reseñas
            'create-review',
            'edit-review',
            'delete-review',
            //Permisos para Tag
            'create-tag',
            'edit-tag',
            'delete-tag',
            //Permisos para SuperAdmin
            'create-admin',
            'edit-admin',
            'delete-admin',
            // Agrega más permisos según sea necesario
        ];
        foreach ($permissions as $permission) {
            // Verificar si el permiso ya existe
            if (Permission::where('name', $permission)->exists()) {
                $this->info("El permiso '$permission' ya existe.");
            } else {
                // Crear el permiso si no existe
                Permission::create(['name' => $permission]);
                $this->info("El permiso '$permission' ha sido creado correctamente.");
            }
        }

        $this->info('Permisos predeterminados creados correctamente.');
    }
}
