<?php

namespace Dashboard\Facades;

use RuntimeException;

abstract class Facade
{
    /**
     * The name of the resolved facade instance
     *
     * @var array
     */
    protected static $resolvedInstanceName;

    /**
     * Get the root object behind the facade
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstanceName(static::$resolvedInstanceName);
    }

    /**
     * Resolve the facade root instance from the container,
     *
     * @return mixed
     */
    protected static function resolveFacadeInstanceName()
    {
        return app()[self::$resolvedInstanceName];
    }

    /**
     * Handle dynamic and static call to the object
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        $instance = static::getFacadeRoot();

        if (! $instance) {
            throw new RuntimeException('A facade root has not been set at Dashboard\\Facades\\Facade::getFacadeRoot().');
        }

        return $instance->$method(...$arguments);
    }
}
