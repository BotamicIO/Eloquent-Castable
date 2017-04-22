<?php



declare(strict_types=1);



namespace BrianFaust\Castable\Casters;

class EncryptedCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value): string
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
