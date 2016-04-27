<?php

/*
 * This file is part of Eloquent Castable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Castable\Traits;

use DraperStudio\Castable\Exceptions\CasterNotInitializable;
use DraperStudio\Castable\Exceptions\CasterNotSpecified;

/**
 * This is the Castable trait.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
trait Castable
{
    /** @var array */
    protected $defaultCasters = [
        'int'        => 'DraperStudio\Castable\Casters\IntegerCaster',
        'integer'    => 'DraperStudio\Castable\Casters\IntegerCaster',
        'real'       => 'DraperStudio\Castable\Casters\FloatCaster',
        'float'      => 'DraperStudio\Castable\Casters\FloatCaster',
        'double'     => 'DraperStudio\Castable\Casters\FloatCaster',
        'string'     => 'DraperStudio\Castable\Casters\StringCaster',
        'bool'       => 'DraperStudio\Castable\Casters\BooleanCaster',
        'boolean'    => 'DraperStudio\Castable\Casters\BooleanCaster',
        'object'     => 'DraperStudio\Castable\Casters\ObjectCaster',
        'array'      => 'DraperStudio\Castable\Casters\ArrayCaster',
        'json'       => 'DraperStudio\Castable\Casters\ArrayCaster',
        'collection' => 'DraperStudio\Castable\Casters\CollectionCaster',
        'date'       => 'DraperStudio\Castable\Casters\DateTimeCaster',
        'datetime'   => 'DraperStudio\Castable\Casters\DateTimeCaster',
        'timestamp'  => 'DraperStudio\Castable\Casters\TimestampCaster',
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

        return call_user_func_array([new $casterClass(), 'cast'], [$value]);
    }
}
