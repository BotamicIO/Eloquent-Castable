<?php

namespace BrianFaust\Castable\Casters;

class FloatCaster extends AbstractCaster
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
        return (float) $value;
    }
}
