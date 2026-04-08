<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableLargeExternalIds
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return [
            'include_external_user_ids' => array_map(fn ($i) => "external_id_{$i}", range(1, 2500)),
        ];
    }
}
