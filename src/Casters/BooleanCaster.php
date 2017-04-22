<?php



declare(strict_types=1);



namespace BrianFaust\Castable\Casters;

class BooleanCaster extends AbstractCaster
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
    public function load($value): bool
    {
        return (bool) $value;
    }
}
