<?php

namespace BrianFaust\Castable\Casters;

abstract class AbstractCaster
{
    public function __construct($options = [])
    {
        $this->options = $options;
    }

    abstract public function cast($value);
}
