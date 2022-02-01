<?php

namespace LaravelFCM\Channels;

use Illuminate\Support\Facades\Log;
use LaravelFCM\FirebaseMessage;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification): void
    {
        $this->buildPayload($notifiable, $notification);
    }
    
    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param Notification $notification
     */
    public function buildPayload(mixed $notifiable, Notification $notification): void
    {
        // Get the message from the notification class
        $fcmMessage = $this->getData($notifiable, $notification);
        
        $messaging = app('firebase.messaging');
        
        foreach ($fcmMessage->getDevices() as $device) {
            try {
                $message = CloudMessage::new()
                    ->withChangedTarget('token', $device->token)
                    ->withNotification($fcmMessage->getNotification()->toArray())
                    ->withData($fcmMessage->getData());
                $messaging->send($message);
            } catch (\Kreait\Firebase\Exception\Messaging\NotFound $exception) {
                $device->delete();
            } catch (\Throwable $exception) {
                Log::error($exception);
            }
        }
    }
    
    
    /**
     * Get the data for the notification.
     *
     * @param mixed                                  $notifiable
     * @param Notification $notification
     *
     * @return FirebaseMessage
     *
     * @throws \RuntimeException
     */
    protected function getData($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toFcm')) {
            return $notification->toFcm($notifiable);
        }
        
        throw new \RuntimeException('Notification is missing toFcm method.');
    }
}
