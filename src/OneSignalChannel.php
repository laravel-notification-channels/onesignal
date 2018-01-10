<?php

namespace NotificationChannels\OneSignal;

use Berkayk\OneSignal\OneSignalClient;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\Exceptions\CouldNotSendNotification;

/**
 * Class OneSignalChannel
 * @package NotificationChannels\OneSignal
 */
class OneSignalChannel
{

    /** @var OneSignalClient */
    protected $oneSignal;

    /**
     * OneSignalChannel constructor.
     *
     * @param \Berkayk\OneSignal\OneSignalClient $oneSignal
     */
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
            $payload['filters'] = collect($this->parseEmailFilter($userIds['email']));
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
     * Parse the User Mails to the OneSignal Specific filter structure
     *
     * @param $userEmails
     *
     * @return array
     */
    protected function parseEmailFilter($userEmails)
    {
        if (is_array($userEmails) == false) {
            $_userEmails[] = $userEmails;
            $userEmails = $_userEmails;
        }
        $count_mails = count($userEmails);
        $filter = [];
        // Go through the array
        for ($i = 0; $i < $count_mails; $i++) {
            // First parse the value
            $filter[] = ['field' => 'email', 'value' => $userEmails[$i]];
            // When the index is < than $count_mails -1 set the "OR" operator
            // Doesnt set it on the last mail so -1
            if ($i < ($count_mails - 1)) {
                $filter[] = ['operator' => 'OR'];
            }
        }

        return $filter;
    }
}
