<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Model\Singleton;

/**
 * Trait Singleton
 * When designing applications,
 * it often makes sense conceptually and architecturally to allow access to one and only one instance of a particular class.
 * The singleton pattern enables us to do this.
 *
 * We declare a trait that can be used in many of the classes in the application that should be Singletons.
 * Classes that should only be instanced once in the application should be Singletons.
 */
trait SingletonTrait
{
    /**
     * @var mixed $instance
     */
    private static $instances = array();

    /**
     * SingletonTrait constructor.
     * Protected, to prevent instantiation.
     */
    protected function __construct()
    {
        // Thou shalt not construct that which is unconstructable!...Is that a word?...
    }

    /**
     * SingletonTrait cloning function.
     * Protected, to prevent clones.
     */
    protected function __clone()
    {
        // Me not like clones! Me smash clones! Hi yah!!!
    }

    /**
     * Call this function to return the Singleton.
     * @return self
     */
    public static function Instance(): self
    {
        $cls = get_called_class(); // late-static-bound class name
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
    }
}