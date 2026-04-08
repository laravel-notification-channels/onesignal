<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableLargePlayerIds
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return array_map(fn ($i) => "player_id_{$i}", range(1, 2500));
    }
}
