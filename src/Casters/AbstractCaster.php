<?php

/*
 * This file is part of Eloquent Castable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Castable\Casters;

/**
 * This is the AbstractCaster class.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
abstract class AbstractCaster
{
    public function __construct($options = [])
    {
        $this->options = $options;
    }

    abstract public function cast($value);
}
