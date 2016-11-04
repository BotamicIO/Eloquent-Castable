# Eloquent Castable

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/eloquent-castable
```

## Usage

``` php
<?php

class Product extends Eloquent
{
    use BrianFaust\Castable\Traits\Castable;

    protected $casts = [
        'price' => 'money'
    ];

    protected $customCasters = [
        'money' => \App\Casters\MoneyCaster::class
    ];

    public function getMoneyCasterConfig()
    {
        return ['currency' => $this->invoice->currency->code];
    }
}
```

``` php
<?php

use BrianFaust\Castable\Casters\AbstractCaster;

class MoneyCaster extends AbstractCaster
{
    public function cast($value)
    {
        return new Money((int) $value, new Currency($this->options['currency']));
    }
}
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## License

The [The MIT License (MIT)](LICENSE). Please check the [LICENSE](LICENSE) file for more details.
