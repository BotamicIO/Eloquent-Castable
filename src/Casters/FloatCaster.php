<?php



declare(strict_types=1);



namespace BrianFaust\Castable\Casters;

class FloatCaster extends AbstractCaster
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
    public function load($value): float
    {
        return (float) $value;
    }
}
