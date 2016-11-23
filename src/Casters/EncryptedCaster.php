<?php

/*
 * This file is part of Eloquent Castable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
