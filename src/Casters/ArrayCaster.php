<?php

namespace BrianFaust\Castable\Casters;

class ArrayCaster extends AbstractCaster
{
    public function cast($value)
    {
        return json_decode($value);
    }
}
