Fake SMS Notifier
====================

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

## License

This bundle is released under the MIT license.
