<?php

namespace NotificationChannels\OneSignal;

use Berkayk\OneSignal\OneSignalClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\OneSignal\Exceptions\InvalidConfiguration;

class OneSignalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $oneSignalClient = new OneSignalClient(
            config('services.onesignal.app_id'),
            config('services.onesignal.rest_api_key'),
            ''
        );

        Notification::extend('onesignal', function () use ($oneSignalClient) {
            return new OneSignalChannel($oneSignalClient);
        });

        $this->app->when(OneSignalChannel::class)
            ->needs(OneSignalClient::class)
            ->give(function () use ($oneSignalClient) {
                $oneSignalConfig = $this->app['config']->get('services.onesignal');

                if (is_null($oneSignalConfig)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return $oneSignalClient;
            });
    }
}
