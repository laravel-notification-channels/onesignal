<?php

namespace NotificationChannels\OneSignal\Test;

class NotifiableIncludesExternalIds
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['include_external_user_ids' => ['external_id']];
    }
}
