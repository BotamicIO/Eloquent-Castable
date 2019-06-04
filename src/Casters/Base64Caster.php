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

class Base64Caster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value): string
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
