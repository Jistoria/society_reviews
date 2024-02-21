<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Utiliza el factory para crear mil usuarios
        $users = User::factory()->count(1000)->create();

        // Obtén el rol "Civil"
        $civilRole = Role::where('name', 'Civil')->first();

        // Asigna el rol "Civil" a cada usuario creado
        foreach ($users as $user) {
            $user->assignRole($civilRole);
        }
    }
}
