<?php

namespace BrianFaust\Castable\Casters;

class EncryptedCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value)
    {
        return encrypt($value);
    }

    /**
     * {@inheritdoc}
     */
    public function load($value)
    {
        return decrypt($value);
    }
}
