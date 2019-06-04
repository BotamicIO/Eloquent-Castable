# Eloquent Castable

[![Build Status](https://img.shields.io/travis/artisanry/Eloquent-Castable/master.svg?style=flat-square)](https://travis-ci.org/artisanry/Eloquent-Castable)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/artisanry/eloquent-castable.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/artisanry/Eloquent-Castable.svg?style=flat-square)](https://github.com/artisanry/Eloquent-Castable/releases)
[![License](https://img.shields.io/packagist/l/artisanry/Eloquent-Castable.svg?style=flat-square)](https://packagist.org/packages/artisanry/Eloquent-Castable)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require artisanry/eloquent-castable
```

## Usage

``` php
<?php

class Product extends Eloquent
{
    use \Artisanry\Castable\Castable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'money'
    ];

    /**
     * The user defined caster classes.
     *
     * @var array
     */
    protected $customCasters = [
        'money' => \App\Casters\MoneyCaster::class
    ];

    /**
     * Config for \App\Casters\MoneyCaster
     *
     * @return array
     */
    public function getMoneyCasterConfig()
    {
        return ['currency' => $this->invoice->currency->code];
    }
}
```

``` php
<?php

namespace App\Casters;

use Artisanry\Castable\Casters\AbstractCaster;

class MoneyCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function load($value)
    {
        return new Money((int) $value, new Currency($this->options['currency']));
    }
}
```

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@basecode.sh. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://basecode.sh)
