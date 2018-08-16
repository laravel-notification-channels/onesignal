<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableIncludedSegments
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['included_segments' => ['included segments']];
    }
}
