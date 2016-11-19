<?php

namespace BrianFaust\Castable\Casters;

class TimestampCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function load($value)
    {
        return (new DateTimeCaster($this->options))->save($value)->getTimestamp();
    }
}
