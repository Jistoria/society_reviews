<?php

namespace App\Providers;

use App\Events\ReplyNotificationEvent;
use App\Events\UserVerified;
use App\Listeners\NotifyOtherCommentersListener;
use App\Listeners\SendReplyNotificationListener;
use App\Listeners\SendWelcomeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserVerified::class => [
            SendWelcomeNotification::class,
        ],
        ReplyNotificationEvent::class => [
            SendReplyNotificationListener::class,
            NotifyOtherCommentersListener::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
