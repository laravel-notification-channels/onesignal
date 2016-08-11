<?php

namespace NotificationChannels\OneSignalNotifications;

use Berkayk\OneSignal\OneSignalClient;
use NotificationChannels\OneSignalNotifications\Exceptions\CouldNotSendNotification;
use NotificationChannels\OneSignalNotifications\Events\MessageWasSent;
use NotificationChannels\OneSignalNotifications\Events\SendingMessage;
use Illuminate\Notifications\Notification;
use Psr\Http\Message\ResponseInterface;

class Channel
{
    /**
     * @var OneSignalClient
     */
    protected $onesignal;

    public function __construct($onesignal)
    {
        $this->onesignal = $onesignal;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\OneSignalNotifications\Exceptions\CouldNotSendNotification
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

        $oneSignalData = collect($notification->toOneSignal($notifiable)->toArray())
            ->put('include_player_ids', collect($userIds));

        /** @var ResponseInterface $response */
        $response = $this->onesignal->sendNotificationCustom($oneSignalData);
        
        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        event(new MessageWasSent($notifiable, $notification));
    }
}
