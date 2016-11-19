<?php

namespace BrianFaust\Castable\Casters;

class BooleanCaster extends AbstractCaster
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
        return (bool) $value;
    }
}
