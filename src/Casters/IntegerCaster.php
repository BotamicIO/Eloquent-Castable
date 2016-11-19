<?php

namespace BrianFaust\Castable\Casters;

class IntegerCaster extends AbstractCaster
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
        return (int) $value;
    }
}
