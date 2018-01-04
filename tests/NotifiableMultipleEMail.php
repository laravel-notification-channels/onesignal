<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableMultipleEMail
{

    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['email' => ['test@example.com', 'test2@example.com']];
    }
}
