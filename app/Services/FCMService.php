<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FCMService
{
    protected $messaging;

    public function __construct()
    {
        // Initialize Firebase with the service account credentials
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->messaging = $factory->createMessaging();
    }

    /**
     * Send a notification using FCM
     *
     * @param string $deviceToken The device token to which the notification will be sent
     * @param string $title The title of the notification
     * @param string $body The body content of the notification
     * @return void
     */
    public function sendNotification($deviceToken, $title, $body)
    {
        // Create the message object for FCM
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification([
                'title' => $title,
                'body' => $body,
            ]);

        // Send the message
        $this->messaging->send($message);
    }
}
