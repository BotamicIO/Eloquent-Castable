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

use DraperStudio\Castable\Contracts\Caster;

/**
 * This is the ArrayCaster class.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class ArrayCaster extends AbstractCaster
{
    public function cast($value)
    {
        return json_decode($value);
    }
}
