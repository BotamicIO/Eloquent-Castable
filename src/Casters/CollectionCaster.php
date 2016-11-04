<?php

namespace BrianFaust\Castable\Casters;

use Illuminate\Support\Collection;

class CollectionCaster extends AbstractCaster
{
    public function cast($value)
    {
        return new Collection(json_decode($value));
    }
}
