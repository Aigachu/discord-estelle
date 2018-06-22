<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Singleton;

/**
 * Trait Singleton
 */
trait SingletonTrait
{
    /**
     * @var mixed $instance
     */
    protected static $instance = null;

    /**
     * SingletonTrait constructor.
     * Protected, to prevent instantiation.
     */
    protected function __construct()
    {
        // Thou shalt not construct that which is unconstructable!
    }

    /**
     * SingletonTrait cloning function.
     * Protected, to prevent clones.
     */
    protected function __clone()
    {
        // Me not like clones! Me smash clones!
    }

    /**
     * Call this function to return the Singleton.
     * @return mixed
     */
    public static function Instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}