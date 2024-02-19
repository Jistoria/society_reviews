<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $new_user = ['name'=>"Jistoria", 'email'=>"maestrojgcm@gmail.com", 'color'=>"#ff80ff", 'password'=>"johan07141234"];
        $user = new User();

        $superAdminRole = Role::where('name', 'Admin')->first();

        if ($superAdminRole) {
            $user->fill($new_user);
            $user->save();

            $user->assignRole($superAdminRole);
        }
        $this->info('Se ha creado el Admin '. $user->name);
}
}
