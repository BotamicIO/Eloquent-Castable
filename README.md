# Eloquent Castable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/eloquent-castable
```

## Usage

``` php
<?php

class User extends Eloquent
{
    use DraperStudio\Castable\Traits\Castable;

    protected $casts = [
        'price' => 'money'
    ];

    protected $customCasters = [
        'money' => \App\Casters\MoneyCaster::class
    ];
}
```

``` php
<?php

use DraperStudio\Castable\Contracts\Caster;

class MoneyCaster implements Caster
{
    public function cast($value)
    {
        return Money\Money::EUR((int) $value);
    }
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/eloquent-castable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Eloquent-Castable/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/eloquent-castable.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/eloquent-castable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/eloquent-castable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/eloquent-castable
[link-travis]: https://travis-ci.org/DraperStudio/Eloquent-Castable
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/eloquent-castable/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/eloquent-castable
[link-downloads]: https://packagist.org/packages/DraperStudio/eloquent-castable
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
