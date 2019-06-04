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

class ArrayCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value): string
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
