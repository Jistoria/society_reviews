<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ReviewAvailableNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;

class NotifyUsersAboutReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Obtener los usuarios a notificar
        $civilRole = Role::where('name', 'Civil')->first();

        // Obtener los usuarios con el rol 'Civil'
        $usersToNotify = $civilRole->users()->get();
        // Puedes ajustar esto según tus necesidades de notificación

        // Iterar sobre los usuarios y enviar la notificación
        foreach ($usersToNotify as $user) {
            $user->notify(new ReviewAvailableNotification($this->data));
        }
    }
}
