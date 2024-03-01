<?php

namespace App\Listeners;

use App\Events\ReplyNotificationEvent;
use App\Notifications\ReplyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReplyNotificationListener
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
    public function handle(ReplyNotificationEvent $event)
    {
        // Accede a la información del comentario desde el evento
        $comment = $event->comment;

        /** Mediante el comentario creado acceder al usuario del comentario padre */
        $comment->parentComment->user->notify(new ReplyNotification($comment->notifyComment()));
    }
}
