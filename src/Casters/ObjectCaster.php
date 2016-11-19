<?php

namespace BrianFaust\Castable\Casters;

class ObjectCaster extends AbstractCaster
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
        return json_decode($value, true);
    }
}
