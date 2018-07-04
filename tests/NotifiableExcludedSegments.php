<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableExcludedSegments
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['excluded_segments' => ['excluded segments']];
    }
}
