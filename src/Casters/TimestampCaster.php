<?php

namespace BrianFaust\Castable\Casters;

class TimestampCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (new DateTimeCaster())->cast($value)->getTimestamp();
    }
}
