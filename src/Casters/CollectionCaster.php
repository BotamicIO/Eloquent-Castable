<?php

namespace BrianFaust\Castable\Casters;

use Illuminate\Support\Collection;

class CollectionCaster extends AbstractCaster
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
        return new Collection(json_decode($value));
    }
}
