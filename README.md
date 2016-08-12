# OneSignal notifications channel for Laravel 5.3 [WIP]

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/onesignal.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/onesignal)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/onesignal/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/onesignal)
[![StyleCI](https://styleci.io/repos/65379321/shield)](https://styleci.io/repos/65379321)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9015691f-130d-4fca-8710-72a010abc684.svg?style=flat-square)](https://insight.sensiolabs.com/projects/9015691f-130d-4fca-8710-72a010abc684)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/onesignal.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/onesignal)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/onesignal.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/onesignal)

This package makes it easy to send [OneSignal notifications](https://documentation.onesignal.com/docs) with Laravel 5.3.
## Contents

- [Installation](#installation)
	- [Setting up your OneSignal account](#setting-up-your-onesignal-account)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/onesignal
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\OneSignal\OneSignalProvider::class,
];
```

### Setting up your OneSignal account

Add your OneSignal App ID and REST API Key to your `config/services.php`:

```php
// config/services.php

    'onesignal' => [
        'app_id' => env('ONESIGNAL_APP_ID'),
        'rest_api_key' => env('ONESIGNAL_REST_API_KEY')
    ]
```


## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\OneSignal\Channel;
use NotificationChannels\OneSignal\Message;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            ->subject("Your {$notifiable->service} account was approved!")
            ->body("Click here to see details.")
            ->url('http://onesignal.com')
            ->webButton('link-1', 'Click here', 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Laravel_logo.png', 'http://laravel.com');
    }
}
```

In order to let your Notification know which OneSignal user(s) you are targeting, add the `routeNotificationForOneSignal` method to your Notifiable model.

```php
public function routeNotificationForOneSignal()
{
    return 'ONE_SIGNAL_PLAYER_ID';
}
```

### All available methods

TODO

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing
    
``` bash
$ composer test
```

## Security

If you discover any security related issues, please email m.pociot@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Mohamed Said](https://github.com/themsaid)
- [Marcel Pociot](https://github.com/mpociot)
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
