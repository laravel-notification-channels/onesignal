<?php

namespace NotificationChannels\OneSignal;

use Berkayk\OneSignal\OneSignalClient;
use NotificationChannels\OneSignal\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use Psr\Http\Message\ResponseInterface;

class OneSignalChannel
{

    /** @var OneSignalClient */
    protected $oneSignal;

    public function __construct(OneSignalClient $oneSignal)
    {
        $this->oneSignal = $oneSignal;
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\OneSignal\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$userIds = $notifiable->routeNotificationFor('OneSignal')) {
            return;
        }

        $payload = $notification->toOneSignal($notifiable)->toArray();
        if (is_array($userIds) && array_key_exists('email', $userIds)) {
            $payload['filters'] = collect($this->parseEmailsToFilters($userIds['email']));
        } else {
            $payload['include_player_ids'] = collect($userIds);
        }
        /** @var ResponseInterface $response */
        $response = $this->oneSignal->sendNotificationCustom($payload);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }

    /**
     * Parse the given E-Mails to the array-format that OneSignal needs.
     *
     * @param mixed $userEmails
     *
     * @return array
     */
    public function parseEmailsToFilters($userEmails)
    {
        if (is_array($userEmails)) {
            return collect($userEmails)->map(function ($email, $key) use ($userEmails) {
                if ($key < (count($userEmails) - 1)) {
                    return [["field" => "email", "relation" => "=", "value" => $email], ['operator' => 'OR']];
                } else {
                    return [["field" => "email", "relation" => "=", "value" => $email]];
                }
            })->flatten(1)->toArray();
        }

        return [["field" => "email", "relation" => "=", "value" => $userEmails]];

    }
}
