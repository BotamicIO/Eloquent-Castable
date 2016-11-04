<?php

namespace BrianFaust\Castable\Casters;

class BooleanCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (bool) $value;
    }
}
