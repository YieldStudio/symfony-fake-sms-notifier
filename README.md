Fake SMS Notifier
====================

[![Latest Version](https://img.shields.io/github/release/yieldstudio/symfony-fake-sms-notifier?style=flat-square)](https://github.com/yieldstudio/symfony-fake-sms-notifier/releases)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/yieldstudio/symfony-fake-sms-notifier/tests?style=flat-square)](https://github.com/yieldstudio/symfony-fake-sms-notifier/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/yieldstudio/symfony-fake-sms-notifier?style=flat-square)](https://packagist.org/packages/yieldstudio/symfony-fake-sms-notifier)

Provides Fake SMS (as email during development) integration for Symfony Notifier.

| Symfony Version | Package Version |
|-----------------|-----------------|
| ~5.1.0          | 0.0.1           |
| ^5.2            | ^1.0.0          |

Installation
-----------

```
composer require yieldstudio/symfony-fake-sms-notifier
```

#### Enable the Bundle

Add following line in `bundles.php`:

```php
YieldStudio\Notifier\FakeSms\FakeSmsNotifierBundle::class => ['all' => true],
```

#### Enable the Fake SMS transport
  
Add the `fakesms` chatter in `config/packages/notifier.yaml`

````yaml
framework:
    notifier:
        texter_transports:
            fakesms: '%env(FAKE_SMS_DSN)%'
````


#### DSN example

```
// .env file
FAKE_SMS_DSN=fakesms://email?to=TO&from=FROM
```

where:
 - `TO` is email who receive SMS during development
 - `FROM` is email who send SMS during development

Running the Tests
---------

Install the [Composer](http://getcomposer.org/) dependencies:

    git clone https://github.com/YieldStudio/symfony-fake-sms-notifier.git
    cd symfony-fake-sms-notifier
    composer update

Then run the test suite:

    composer test

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you've found a bug regarding security please mail [contact@yieldstudio.fr](mailto:contact@yieldstudio.fr) instead of using the issue tracker.

## Credits

- [James Hemery](https://github.com/jameshemery)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
