<?php

namespace NotificationChannels\OneSignal;

use Berkayk\OneSignal\OneSignalClient;
use NotificationChannels\OneSignal\Exceptions\CouldNotSendNotification;
use NotificationChannels\OneSignal\Events\MessageWasSent;
use NotificationChannels\OneSignal\Events\SendingMessage;
use Illuminate\Notifications\Notification;
use Psr\Http\Message\ResponseInterface;

class Channel
{
    /** @var OneSignalClient */
    protected $onesignal;

    public function __construct(OneSignalClient $onesignal)
    {
        $this->onesignal = $onesignal;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\OneSignal\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $userIds = $notifiable->routeNotificationFor('OneSignal')) {
            return;
        }

        $shouldSendMessage = event(new SendingMessage($notifiable, $notification), [], true) !== false;

        if (! $shouldSendMessage) {
            return;
        }

        $payload = $notification->toOneSignal($notifiable)->toArray();
        $payload['include_player_ids'] = collect($userIds);

        /** @var ResponseInterface $response */
        $response = $this->onesignal->sendNotificationCustom($payload);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        event(new MessageWasSent($notifiable, $notification));
    }
}
