<?php

namespace NotificationChannels\OneSignal\Test;

use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalMessage;

class TestSilentNotification extends Notification
{
    public function toOneSignal($notifiable)
    {
        return (new OneSignalMessage())
            ->setSilent()
            ->setData('action', 'reload')
            ->setData('target', 'inbox');
    }
}
