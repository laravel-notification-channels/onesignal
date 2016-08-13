<?php

namespace NotificationChannels\OneSignal\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static('In order to send notification via OneSignal you need to add credentials in the `onesignal` key of `config.services`.');
    }
}
