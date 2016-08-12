<?php

namespace NotificationChannels\OneSignal;

use Berkayk\OneSignal\OneSignalClient;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\OneSignal\Exceptions\InvalidConfiguration;

class OneSignalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(OneSignalChannel::class)
            ->needs(OneSignalClient::class)
            ->give(function () {
                $oneSignalConfig = config('services.onesignal');

                if (is_null($oneSignalConfig)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return new OneSignalClient(
                    $oneSignalConfig['app_id'],
                    $oneSignalConfig['rest_api_key'],
                    ''
                );
            });
    }
}
