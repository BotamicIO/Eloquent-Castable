<?php

namespace BrianFaust\Castable\Traits;

use BrianFaust\Castable\Exceptions\CasterNotInitializable;
use BrianFaust\Castable\Exceptions\CasterNotSpecified;

trait Castable
{
    /** @var array */
    protected $defaultCasters = [
        'int' => 'BrianFaust\Castable\Casters\IntegerCaster',
        'integer' => 'BrianFaust\Castable\Casters\IntegerCaster',
        'real' => 'BrianFaust\Castable\Casters\FloatCaster',
        'float' => 'BrianFaust\Castable\Casters\FloatCaster',
        'double' => 'BrianFaust\Castable\Casters\FloatCaster',
        'string' => 'BrianFaust\Castable\Casters\StringCaster',
        'bool' => 'BrianFaust\Castable\Casters\BooleanCaster',
        'boolean' => 'BrianFaust\Castable\Casters\BooleanCaster',
        'object' => 'BrianFaust\Castable\Casters\ObjectCaster',
        'array' => 'BrianFaust\Castable\Casters\ArrayCaster',
        'json' => 'BrianFaust\Castable\Casters\ArrayCaster',
        'collection' => 'BrianFaust\Castable\Casters\CollectionCaster',
        'date' => 'BrianFaust\Castable\Casters\DateTimeCaster',
        'datetime' => 'BrianFaust\Castable\Casters\DateTimeCaster',
        'timestamp' => 'BrianFaust\Castable\Casters\TimestampCaster',
    ];

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        // merge the default casters with the custom casters
        $casters = array_merge($this->defaultCasters, $this->customCasters ?: []);

        // get the caster type
        $castType = $this->getCastType($key);

        // check if a caster class is specified
        if (!array_key_exists($castType, $casters)) {
            throw new CasterNotSpecified($castType);
        }

        // check if the caster class does exist
        $casterClass = $casters[$castType];

        if (!class_exists($casterClass)) {
            throw new CasterNotInitializable($casterClass);
        }

        // check if we have options for our caster class
        $function = new \ReflectionClass($casterClass);

        $optionsMethodName = 'get'.$function->getShortName().'Config';

        $options = [];
        if (method_exists($this, $optionsMethodName)) {
            $options = $this->{$optionsMethodName}();
        }

        // build the caster and call the cast method
        return call_user_func_array([new $casterClass($options), 'cast'], [$value]);
    }
}
