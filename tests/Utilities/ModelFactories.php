<?php

namespace Tests\Utilities;

/**
 * Trait ModelFactories
 *
 * @package Tests\Utilities
 *
 * @method \App\User|\Illuminate\Database\Eloquent\Collection createUser(array $attributes = [], int $count = null, array $states = [])
 * @method \App\User|\Illuminate\Database\Eloquent\Collection makeUser(array $attributes = [], int $count = null, array $states = [])
 */
trait ModelFactories
{
    /**
     * @param $name
     * @param $arguments
     * @return object
     */
    public function __call($name, $arguments): object
    {
        $pieces = preg_split('/(?=[A-Z])/', $name);
        $method = array_shift($pieces);
        $class = sprintf('App\%s', implode('', $pieces));
        $attributes = $arguments[0] ?? [];
        $count = $arguments[1] ?? null;
        $states = $arguments[2] ?? [];

        return $this->$method($class, $attributes, $count, $states);
    }

    /**
     * @param $class
     * @param array $attributes
     * @param int|null $count
     * @param array $states
     * @return object
     */
    protected function create($class, array $attributes = [], int $count = null, array $states = []): object
    {
        return factory($class, $count)->states($states)->create($attributes);
    }

    /**
     * @param $class
     * @param array $attributes
     * @param int|null $count
     * @param array $states
     * @return object
     */
    protected function make($class, array $attributes = [], int $count = null, array $states = []): object
    {
        return factory($class, $count)->states($states)->make($attributes);
    }
}
