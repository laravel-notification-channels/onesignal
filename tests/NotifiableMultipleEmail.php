<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableMultipleEmail
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['email' => ['test1@example.com','test2@example.com']];
    }
}
