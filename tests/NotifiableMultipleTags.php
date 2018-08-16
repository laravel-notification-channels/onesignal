<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableMultipleTags
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['tags' => [
                ['key' => 'device_uuid', 'relation' => '=', 'value' => '123e4567-e89b-12d3-a456-426655440000'],
                ['key' => 'role', 'relation' => '=', 'value' => 'admin'],
            ],
        ];
    }
}
