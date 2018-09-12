<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Feature;

use Aigachu\Lavenza\Bot\Command\CommandInterface;

use Aigachu\Lavenza\Model\Singleton\SingletonTrait;
use ReflectionClass;

/**
 * Class FeatureBase
 * A Feature is a collection of...Well...Features, that can be attached to a
 * bot.
 *
 * @package Aigachu\Lavenza\Module
 */
abstract class FeatureBase implements FeatureInterface
{

    use SingletonTrait;

    /**
     * @var array $commands
     */
    protected static $commands;

    /**
     * Provides a function to retrieve all commands of the Feature.
     *
     * @return array
     */
    public static function getCommands() : array
    {
        return self::$commands;
    }

    /**
     * FeatureBase constructor.
     *
     * @throws \ReflectionException
     */
    protected function __construct()
    {
        // This process will seamlessly load all commands found in a Command folder found at the root of the module.
        $reflector = new ReflectionClass(\get_class($this));
        $class_directory = \dirname($reflector->getFileName());
        $namespace = $reflector->getNamespaceName();
        $commandClasses = array_filter(glob($class_directory.'/Command/*.php'));

        // Load all Command Classes and attach them to the Feature object.
        foreach ($commandClasses as $class_path) {
            $filename = str_replace(
                $class_directory.'/Command/', '', $class_path
            );
            $class_name = str_replace('.php', '', $filename);

            /** @var SingletonTrait|CommandInterface $class */
            $class = '\\'.$namespace.'\\Command\\'.$class_name;
            $command = $class::Instance();
            self::$commands[$command->env][$command->key] = $command;
        }
    }
}