<?php

/*
 * This file is part of Eloquent Castable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Castable;

use Illuminate\Support\Str;
use InvalidArgumentException;

trait Castable
{
    /**
     * The default attribute casters.
     *
     * @var array
     */
    protected $casters = [
        'int'        => Casters\IntegerCaster::class,
        'integer'    => Casters\IntegerCaster::class,
        'real'       => Casters\FloatCaster::class,
        'float'      => Casters\FloatCaster::class,
        'double'     => Casters\FloatCaster::class,
        'string'     => Casters\StringCaster::class,
        'bool'       => Casters\BooleanCaster::class,
        'boolean'    => Casters\BooleanCaster::class,
        'object'     => Casters\ObjectCaster::class,
        'array'      => Casters\ArrayCaster::class,
        'json'       => Casters\ArrayCaster::class,
        'collection' => Casters\CollectionCaster::class,
        'date'       => Casters\DateTimeCaster::class,
        'datetime'   => Casters\DateTimeCaster::class,
        'timestamp'  => Casters\TimestampCaster::class,
        'encrypted'  => Casters\EncryptedCaster::class,
        'base64'     => Casters\Base64Caster::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        return $this->getCaster($key)->load($value);
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute($key, $value)
    {
        // First we will check for the presence of a mutator for the set operation
        // which simply lets the developers tweak the attribute as it is set on
        // the model, such as "json_encoding" an listing of data for storage.
        if ($this->hasSetMutator($key)) {
            $method = 'set'.Str::studly($key).'Attribute';

            return $this->{$method}($value);
        }

        // Check if any caster are applicable
        $value = $this->applyCaster($key, $value);

        // If this attribute contains a JSON ->, we'll set the proper value in the
        // attribute's underlying array. This takes care of properly nesting an
        // attribute in the array's value in the case of deeply nested items.
        if (Str::contains($key, '->')) {
            return $this->fillJsonAttribute($key, $value);
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function fromDateTime($value)
    {
        return $this->getCaster(null, 'datetime', [
            'format' => $this->getDateFormat(),
        ])->load($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function asDateTime($value)
    {
        return $this->getCaster(null, 'datetime', [
            'format' => $this->getDateFormat(),
        ])->save($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function asTimeStamp($value)
    {
        return $this->getCaster(null, 'timestamp', [
            'format' => $this->getDateFormat(),
        ])->save($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function asBase64($value)
    {
        return $this->getCaster(null, 'base64')->save($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function asEncrypted($value)
    {
        return $this->getCaster(null, 'encrypted')->save($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function asJson($value)
    {
        return $this->getCaster(null, 'json')->save($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function isBase64Castable($key)
    {
        return $this->hasCast($key, ['base64']);
    }

    /**
     * {@inheritdoc}
     */
    protected function isEncryptCastable($key)
    {
        return $this->hasCast($key, ['encrypted']);
    }

    /**
     * {@inheritdoc}
     */
    protected function getCastType($key)
    {
        if (! array_key_exists($key, $this->getCasts())) {
            return;
        }

        return trim(strtolower($this->getCasts()[$key]));
    }

    /**
     * Get a new caster instance.
     *
     * @param string      $key
     * @param string|null $castType
     * @param array       $options
     *
     * @return \BrianFaust\Castable\Casters\AbstractCaster
     */
    private function getCaster($key, $castType = null, $options = [])
    {
        $casters = array_merge($this->casters, $this->customCasters);

        if (! $castType) {
            $castType = $this->getCastType($key);
        }

        if (! array_key_exists($castType, $casters)) {
            throw new InvalidArgumentException($castType);
        }

        $casterClass = $casters[$castType];

        if (! $options) {
            $options = $this->getCasterOptions($casterClass);
        }

        return new $casterClass($this, $options);
    }

    /**
     * @param string $class
     *
     * @return array
     */
    private function getCasterOptions(string $class)
    {
        $reflection = new \ReflectionClass($class);
        $optionsMethodName = 'get'.$reflection->getShortName().'Config';

        $options = [];
        if (method_exists($this, $optionsMethodName)) {
            $options = $this->{$optionsMethodName}();
        }

        return $options;
    }

    /**
     * @return mixed
     */
    private function applyCaster($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        if ($this->hasCast($key, ['int', 'integer'])) {
            return $this->getCaster(null, 'int')->save($value);
        }

        if ($this->hasCast($key, ['real', 'float', 'double'])) {
            return $this->getCaster(null, 'real')->save($value);
        }

        if ($this->hasCast($key, ['string'])) {
            return $this->getCaster(null, 'string')->save($value);
        }

        if ($this->hasCast($key, ['bool', 'boolean'])) {
            return $this->getCaster(null, 'bool')->save($value);
        }

        if ($this->hasCast($key, ['object'])) {
            return $this->getCaster(null, 'object')->save($value);
        }

        if ($this->hasCast($key, ['array', 'json'])) {
            return $this->getCaster(null, 'array')->save($value);
        }

        if ($this->hasCast($key, ['collection'])) {
            return $this->getCaster(null, 'collection')->save($value);
        }

        if ($this->hasCast($key, ['date', 'datetime']) && in_array($key, $this->getDates())) {
            return $this->getCaster(null, 'date', [
                'format' => $this->getDateFormat(),
            ])->save($value);
        }

        if ($this->hasCast($key, ['timestamp'])) {
            return $this->getCaster(null, 'timestamp', [
                'format' => $this->getDateFormat(),
            ])->save($value);
        }

        if ($this->hasCast($key, ['encrypted'])) {
            return $this->getCaster(null, 'encrypted')->save($value);
        }

        if ($this->hasCast($key, ['base64'])) {
            return $this->getCaster(null, 'base64')->save($value);
        }

        return $value;
    }
}
