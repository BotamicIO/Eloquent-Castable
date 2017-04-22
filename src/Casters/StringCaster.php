<?php



declare(strict_types=1);



namespace BrianFaust\Castable\Casters;

class StringCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value): string
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function load($value): string
    {
        return (string) $value;
    }
}
