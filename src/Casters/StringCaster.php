<?php

namespace BrianFaust\Castable\Casters;

class StringCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (string) $value;
    }
}
