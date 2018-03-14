<?php

namespace NotificationChannels\OneSignal\Traits;


use NotificationChannels\OneSignal\Traits\Categories\AppearanceHelpers;
use NotificationChannels\OneSignal\Traits\Categories\AttachmentHelpers;
use NotificationChannels\OneSignal\Traits\Categories\DeliveryHelpers;

trait OneSignalHelpers
{

    use AppearanceHelpers, AttachmentHelpers, DeliveryHelpers;
}