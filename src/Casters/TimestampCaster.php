<?php



declare(strict_types=1);



namespace BrianFaust\Castable\Casters;

class TimestampCaster extends AbstractCaster
{
    /**
     * {@inheritdoc}
     */
    public function save($value): int
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function load($value): int
    {
        return (new DateTimeCaster($this->options))->save($value)->getTimestamp();
    }
}
