<?php

namespace NotificationChannels\OneSignal\Traits;

use NotificationChannels\OneSignal\Traits\Categories\ButtonHelpers;
use NotificationChannels\OneSignal\Traits\Categories\DeliveryHelpers;
use NotificationChannels\OneSignal\Traits\Categories\GroupingHelpers;
use NotificationChannels\OneSignal\Traits\Categories\AppearanceHelpers;
use NotificationChannels\OneSignal\Traits\Categories\AttachmentHelpers;

trait OneSignalHelpers
{
    use AppearanceHelpers, AttachmentHelpers, ButtonHelpers, DeliveryHelpers, GroupingHelpers;
}
