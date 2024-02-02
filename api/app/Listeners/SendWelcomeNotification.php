<?php

namespace App\Listeners;

use App\Events\UserVerified;
use App\Notifications\WelcomeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserVerified $event): void
    {
        $userName = $event->user->name;
        $event->user->notify(new WelcomeNotification($userName));
    }
}
