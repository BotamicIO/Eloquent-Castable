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

use Illuminate\Database\Eloquent\Model;

abstract class AbstractCaster
{
    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @var array */
    protected $options;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array                               $options
     */
    public function __construct(Model $model, array $options)
    {
        $this->model = $model;
        $this->options = $options;
    }

    /**
     * Prepare a value to be saved.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    abstract public function save($value);

    /**
     * Prepare a value to be read.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    abstract public function load($value);
}
