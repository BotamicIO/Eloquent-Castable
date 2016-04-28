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
 * This is the StringCaster class.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class StringCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (string) $value;
    }
}
