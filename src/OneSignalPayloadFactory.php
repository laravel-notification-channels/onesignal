<?php

namespace NotificationChannels\OneSignal;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;

class OneSignalPayloadFactory
{
    /**
     * Default number of player IDs or external user IDs per API request (OneSignal limit).
     */
    public const DEFAULT_CHUNK_SIZE = 2000;

    /**
     * Make a one signal notification payload.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @param  mixed  $targeting
     * @return array
     */
    public static function make($notifiable, Notification $notification, $targeting): array
    {
        $payload = $notification->toOneSignal($notifiable)->toArray();

        if (static::isTargetingEmail($targeting)) {
            $payload['filters'] = collect([['field' => 'email', 'value' => $targeting['email']]]);
        } elseif (static::isTargetingTags($targeting)) {
            $array = $targeting['tags'];
            $res = count($array) == count($array, COUNT_RECURSIVE);
            if ($res) {
                $payload['tags'] = collect([$targeting['tags']]);
            } else {
                $payload['tags'] = collect($targeting['tags']);
            }
        } elseif (static::isTargetingIncludedSegments($targeting)) {
            $payload['included_segments'] = collect($targeting['included_segments']);
        } elseif (static::isTargetingExcludedSegments($targeting)) {
            $payload['excluded_segments'] = collect($targeting['excluded_segments']);
        } elseif (static::isTargetingExternalUserIds($targeting)) {
            $payload['include_external_user_ids'] = collect($targeting['include_external_user_ids']);
        } else {
            $payload['include_player_ids'] = collect($targeting);
        }

        return $payload;
    }

    /**
     * Split targeting into chunks for API requests (player IDs and external user IDs only).
     * OneSignal accepts at most 2,000 IDs per request for include_player_ids and include_external_user_ids.
     *
     * @param  mixed  $targeting  Result of routeNotificationFor('OneSignal')
     * @param  int  $chunkSize  Max IDs per request (default 2000)
     * @return array<array> List of targeting arrays, one per chunk
     */
    public static function getTargetingChunks($targeting, int $chunkSize = self::DEFAULT_CHUNK_SIZE): array
    {
        if (static::isTargetingExternalUserIds($targeting)) {
            $ids = $targeting['include_external_user_ids'];
            $ids = is_array($ids) ? array_values($ids) : [$ids];
            if (count($ids) <= $chunkSize) {
                return [$targeting];
            }
            $chunks = array_chunk($ids, $chunkSize);

            return array_map(fn (array $chunk) => ['include_external_user_ids' => $chunk], $chunks);
        }

        if (static::isTargetingPlayerIds($targeting)) {
            $ids = Arr::wrap($targeting);
            $ids = array_values($ids);
            if (count($ids) <= $chunkSize) {
                return [$targeting];
            }

            return array_chunk($ids, $chunkSize);
        }

        return [$targeting];
    }

    /**
     * @param  mixed  $targeting
     * @return bool
     */
    protected static function isTargetingPlayerIds($targeting)
    {
        return ! static::isTargetingEmail($targeting)
            && ! static::isTargetingTags($targeting)
            && ! static::isTargetingIncludedSegments($targeting)
            && ! static::isTargetingExcludedSegments($targeting)
            && ! static::isTargetingExternalUserIds($targeting);
    }

    /**
     * @param  mixed  $targeting
     * @return bool
     */
    protected static function isTargetingIncludedSegments($targeting)
    {
        return is_array($targeting) && array_key_exists('included_segments', $targeting);
    }

    /**
     * @param  mixed  $targeting
     * @return bool
     */
    protected static function isTargetingExternalUserIds($targeting)
    {
        return is_array($targeting) && array_key_exists('include_external_user_ids', $targeting);
    }

    /**
     * @param  mixed  $targeting
     * @return bool
     */
    protected static function isTargetingExcludedSegments($targeting)
    {
        return is_array($targeting) && array_key_exists('excluded_segments', $targeting);
    }

    /**
     * @param  mixed  $targeting
     * @return bool
     */
    protected static function isTargetingEmail($targeting)
    {
        return is_array($targeting) && array_key_exists('email', $targeting);
    }

    /**
     * @param  mixed  $targeting
     * @return bool
     */
    protected static function isTargetingTags($targeting)
    {
        return is_array($targeting) && array_key_exists('tags', $targeting);
    }
}
