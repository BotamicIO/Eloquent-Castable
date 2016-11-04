<?php

namespace BrianFaust\Castable\Casters;

class FloatCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (float) $value;
    }
}
