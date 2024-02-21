<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewAvailableNotification extends Notification
{
    use Queueable;
    protected $franchiseTitle;
    protected $reviewTitle;
    protected $userName;
    protected $contentType;
    protected $slug;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->franchiseTitle = $data['title'];
        $this->reviewTitle = $data['title_alternative'];
        $this->userName = $data['name'];
        $this->contentType = $data['type'];
        $this->slug = $data['slug'];
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
     * Get the broadcastable representation of the notification.
     *
     * @return BroadcastMessage
     */
    public function toDatabase(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => "{$this->franchiseTitle} - {$this->contentType}",
            'message' => "Se ha publicado la reseña {$this->reviewTitle}, del usuario {$this->userName}",
            'url' => "{$this->slug}"
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
