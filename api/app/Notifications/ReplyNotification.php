<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyNotification extends Notification
{
    use Queueable;

    private $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct($comment)
    {
        //
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
                'title' => "Reseña: {$this->comment['title']}",
                'data' => "{$this->comment['name']} respondió tu comentario en {$this->comment['title']}",
                'slug' => $this->comment['slug']
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    public function databaseType(object $notifiable): string
{
    return 'notify-comment';
}
}
