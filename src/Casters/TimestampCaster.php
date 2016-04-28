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
 * This is the TimestampCaster class.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class TimestampCaster extends AbstractCaster
{
    public function cast($value)
    {
        return (new DateTimeCaster())->cast($value)->getTimestamp();
    }
}
