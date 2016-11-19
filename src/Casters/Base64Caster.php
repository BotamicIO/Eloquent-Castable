<?php

namespace BrianFaust\Castable\Casters;

class Base64Caster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value)
    {
        return base64_encode($value);
    }

    /**
     * {@inheritdoc}
     */
    public function load($value)
    {
        return base64_decode($value);
    }
}
