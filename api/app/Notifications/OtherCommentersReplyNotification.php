<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtherCommentersReplyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $data;
    private $nameParent;
    public function __construct($data, $nameParent)
    {
        $this->data = $data;
        $this->nameParent = $nameParent;
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
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
                'title' => "Reseña: {$this->data['title']}",
                'data' => "{$this->nameParent} tambien ha respondido el comentario de {$this->data['name']},
                                en la reseña {$this->data['title']}",
                'slug' => $this->data['slug']
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
}
