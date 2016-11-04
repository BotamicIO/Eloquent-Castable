<?php

namespace BrianFaust\Castable\Casters;

class IntegerCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (int) $value;
    }
}
