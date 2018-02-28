<?php

namespace NotificationChannels\OneSignal;

use Illuminate\Notifications\Notification;

class OneSignalPayloadFactory
{
    /**
     * Make a one signal notification payload.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @param mixed $targeting
     *
     * @return array
     */
    public static function make($notifiable, Notification $notification, $targeting) : array
    {
        $payload = $notification->toOneSignal($notifiable)->toArray();

        if (static::isTargetingEmail($targeting)) {
            $payload['filters'] = collect([['field' => 'email', 'value' => $targeting['email']]]);
        } elseif (static::isTargetingTags($targeting)) {
            $payload['tags'] = collect([$targeting['tags']]);
        } else {
            $payload['include_player_ids'] = collect($targeting);
        }

        return $payload;
    }

    /**
     * @param mixed $targeting
     *
     * @return bool
     */
    protected static function isTargetingEmail($targeting)
    {
        return is_array($targeting) && array_key_exists('email', $targeting);
    }

    protected static function isTargetingTags($targeting)
    {
        return is_array($targeting) && array_key_exists('tags', $targeting);
    }
}
