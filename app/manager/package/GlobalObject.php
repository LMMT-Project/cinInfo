<?php

namespace CMW\Manager\Pacakge;

abstract class GlobalObject
{

    protected static GlobalObject $_instance;

    /**
     * @return static Controller instance
     */
    final public static function getInstance(): static
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

}