<?php

declare(strict_types=1);

/*
 * This file is part of Eloquent Castable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Castable\Casters;

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
    public function load($value): Collection
    {
        return new Collection(json_decode($value));
    }
}
