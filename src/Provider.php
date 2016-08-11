<?php

namespace NotificationChannels\OneSignal;

use Berkayk\OneSignal\OneSignalClient;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(Channel::class)
            ->needs(OneSignalClient::class)
            ->give(function () {
                $oneSignalConfig = config('services.onesignal');

                return new OneSignalClient(
                    $oneSignalConfig['app_id'],
                    $oneSignalConfig['rest_api_key'],
                    ''
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
