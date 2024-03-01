<?php

namespace App\Listeners;

use App\Events\ReplyNotificationEvent;
use App\Models\Comment;
use App\Notifications\OtherCommentersReplyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOtherCommentersListener
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
    public function handle(ReplyNotificationEvent $event): void
{
    // Obtener el comentario padre
    $parentComment = $event->comment->parentComment;

    // Verificar si el comentario padre tiene más comentarios hijos
    if ($parentComment && $parentComment->replies()->count() > 1) {
        // Obtener los otros usuarios que han comentado en respuesta al mismo comentario padre
        $otherCommenters = Comment::where('com_comment_id', $parentComment->comment_id)
            ->where('user_id', '!=', $event->comment->user_id) // Excluir al usuario actual
            ->whereNotNull('com_comment_id') // Verificar que sea un comentario hijo
            ->distinct('user_id')
            ->pluck('user_id');

        // Enviar notificación a los otros usuarios
        foreach ($otherCommenters as $userId) {
            $user = \App\Models\User::find($userId);
            if ($user) { // Asegurarse de que el usuario exista antes de enviar la notificación
                $user->notify(new OtherCommentersReplyNotification($parentComment->notifyComment(), $event->comment->user->name));
            }
        }
    }
}
}
