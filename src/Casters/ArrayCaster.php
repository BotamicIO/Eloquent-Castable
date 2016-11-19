<?php

namespace BrianFaust\Castable\Casters;

class ArrayCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value)
    {
        return json_encode($value);
    }

    /**
     * {@inheritdoc}
     */
    public function load($value)
    {
        return json_decode($value, $this->options->asObject);
    }
}
