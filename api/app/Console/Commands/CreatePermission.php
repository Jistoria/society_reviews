<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permission {name : The name of the permission}';

    /**
     * The console command description.
     *
     * @var string
     */
    /**
     * Execute the console command.
     */
    protected $description = 'Create a new permission';



    public function handle()
    {
        $permissionName = $this->argument('name');

        // Verificar si el permiso ya existe
        if (Permission::where('name', $permissionName)->exists()) {
            $this->error('El permiso ya existe.');
            return;
        }

        // Crear el permiso
        Permission::create(['name' => $permissionName]);

        $this->info("El permiso '$permissionName' ha sido creado correctamente.");
    }

}
