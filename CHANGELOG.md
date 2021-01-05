# Changelog

All Notable changes to `onesignal` will be documented in this file

## 2.3.0 - 2021-01-05
- Add support for PHP 8

## 2.2.0 - 2021-01-05
- Add compatibility for Laravel 8

## 2.1.0 - 2020-03-05
- Add compatibility for Laravel 7
- Add testing on PHP 7.4

## 2.0.0 - 2019-09-17
- Add compatibility for Laravel 6
- Remove testing on old PHP versions (7.0,7.1) and test on 7.3 

## 2.0.0-RC2 - 2019-02-07
- Update the underlying **berkayk/onesignal-laravel** Package to v1.0.1 ([#60](https://github.com/laravel-notification-channels/onesignal/pull/60))

## 2.0.0-RC1 - 2019-01-03
- [Refactor] Switch to trait based class ordering ([#58](https://github.com/laravel-notification-channels/onesignal/pull/58))
- [Feature] Allow sending to multiple tags ([#73](https://github.com/laravel-notification-channels/onesignal/pull/73))
- [Feature] Allow sending with an empty subject ([#56](https://github.com/laravel-notification-channels/onesignal/pull/56))
- [Feature] Allow more customisation of the notification ([#55](https://github.com/laravel-notification-channels/onesignal/pull/55) & [#58](https://github.com/laravel-notification-channels/onesignal/pull/58))
- [Feature] Add support for silent messages ([#67](https://github.com/laravel-notification-channels/onesignal/pull/67))
- [Feature] Add support for setting a template ([#77](https://github.com/laravel-notification-channels/onesignal/pull/77))
- [Feature] Allow sending to segments based on "included and excluded" ([#72](https://github.com/laravel-notification-channels/onesignal/pull/72))
- [Feature] Allow sending to external user IDs ([#86](https://github.com/laravel-notification-channels/onesignal/pull/86))

## 1.2.0 - 2018-03-09
- [Feature] Added targetting per Tags ([#48](https://github.com/laravel-notification-channels/onesignal/pull/48))
- [Refactor] Implement payload Factory ([#50](https://github.com/laravel-notification-channels/onesignal/pull/50))

## 1.1.1 - 2018-02-09
- [Feature] Added return for response after sending the message ([#46](https://github.com/laravel-notification-channels/onesignal/pull/46))

## 1.1.0 - 2018-01-08
- Min. PHP Version is now PHP 7.0 and tests were executed on php 7.2 ([#44](https://github.com/laravel-notification-channels/onesignal/pull/44))
- [Feature] Added possibility to send a Notification based on the User E-Mail ([#40](https://github.com/laravel-notification-channels/onesignal/pull/40))
- [Feature] Added method to set any parameter on the message ([23](https://github.com/laravel-notification-channels/onesignal/pull/23))
- [Feature] Added method to set all image attachments at once ([#42](https://github.com/laravel-notification-channels/onesignal/pull/42))

## 1.0.2 - 2018-01-03

- Add compatiblity for Laravel 5.5 

## 1.0.0 - 2016-01-01

- Initial release
