<?php

use LaravelFCM\FirebaseMessage;
use Illuminate\Notifications\Notification;
use LaravelFCM\FirebaseNotification;

class TestNotify extends Notification
{
    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['fcm'];
    }

    /**
     * @param mixed $notifiable
     *
     * @return null|FirebaseMessage
     */
    public function toFcm(mixed $notifiable): ?FirebaseMessage
    {
        return FirebaseMessage::new()
            ->setNotification(
                new FirebaseNotification('Title', 'body')
            )
            ->setDevices([]);
    }
}