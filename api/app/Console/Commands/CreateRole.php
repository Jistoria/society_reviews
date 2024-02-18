<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    protected $signature = 'create:roles';
    protected $description = 'Create a all roles';

    public function handle()
    {
        $roleNames = ['SuperAdmin', 'Admin', 'Civil'];

        // Crear roles o ignorarlos si ya existen
        foreach ($roleNames as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
            $this->info("El rol '$roleName' ha sido creado correctamente.");
        }


    }
}
