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
    public static function make($notifiable, Notification $notification, $targeting): array
    {
        $payload = $notification->toOneSignal($notifiable)->toArray();

        if (static::isTargetingEmail($targeting)) {
            $payload['filters'] = collect([['field' => 'email', 'value' => $targeting['email']]]);
        } elseif (static::isTargetingTags($targeting)) {
            $payload['tags'] = collect([$targeting['tags']]);
        } elseif (static::isTargetingIncludedSegments($targeting)) {
            $payload['included_segments'] = collect($targeting['included_segments']);
        } elseif (static::isTargetingExcludedSegments($targeting)) {
            $payload['excluded_segments'] = collect($targeting['excluded_segments']);
        } else {
            $payload['include_player_ids'] = collect($targeting);
        }
        //dd($payload);

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

    /**
     * @param mixed $targeting
     *
     * @return bool
     */
    protected static function isTargetingTags($targeting)
    {
        return is_array($targeting) && array_key_exists('tags', $targeting);
    }

    /**
     * @param mixed $targeting
     *
     * @return bool
     */
    protected static function isTargetingIncludedSegments($targeting)
    {
        return is_array($targeting) && array_key_exists('included_segments', $targeting);
    }

    /**
     * @param mixed $targeting
     *
     * @return bool
     */
    protected static function isTargetingExludedSegments($targeting)
    {
        return is_array($targeting) && array_key_exists('excluded_segments', $targeting);
    }
}
