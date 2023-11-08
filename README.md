# Create a simple integration for PIN Profile verification

## The principal objective of this package is create a simple integration for PIN Profile verification, sending a PIN (can be alphanumerice) to the user email
so he can verify the account

[![Latest Version on Packagist](https://img.shields.io/packagist/v/php-dominicana/alphapin-profile-guardian.svg?style=flat-square)](https://packagist.org/packages/php-dominicana/alphapin-profile-guardian)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/php-dominicana/alphapin-profile-guardian/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/php-dominicana/alphapin-profile-guardian/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/php-dominicana/alphapin-profile-guardian/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/php-dominicana/alphapin-profile-guardian/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/php-dominicana/alphapin-profile-guardian.svg?style=flat-square)](https://packagist.org/packages/php-dominicana/alphapin-profile-guardian)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require php-dominicana/alphapin-profile-guardian
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="alphapin-profile-guardian-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="alphapin-profile-guardian-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="alphapin-profile-guardian-views"
```

## Usage

```php
$alphapinProfileGuardian = new PHPDominicana\AlphapinProfileGuardian();
echo $alphapinProfileGuardian->echoPhrase('Hello, PHPDominicana!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [PHP Dominicana](https://github.com/PHP-Dominicana)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
