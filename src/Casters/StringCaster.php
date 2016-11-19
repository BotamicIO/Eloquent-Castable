<?php

namespace BrianFaust\Castable\Casters;

class StringCaster extends AbstractCaster
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
        return (string) $value;
    }
}
