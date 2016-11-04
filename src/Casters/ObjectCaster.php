<?php

namespace BrianFaust\Castable\Casters;

class ObjectCaster extends AbstractCaster
{
    public function cast($value)
    {
        return json_decode($value, true);
    }
}
