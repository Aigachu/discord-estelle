<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Module;

use Aigachu\Lavenza\Singleton\SingletonTrait;
use ReflectionClass;

/**
 * Class ModuleBase
 * @package Aigachu\Lavenza\Module
 */
abstract class ModuleBase implements ModuleInterface
{
    use SingletonTrait;

    /**
     * @var array $commands
     */
    protected static $commands;

    /**
     * @return array
     */
    public static function getCommands(): array
    {
        return self::$commands;
    }

    /**
     * ModuleBase constructor.
     */
    protected function __construct()
    {
        $reflector = new ReflectionClass(get_class($this));
        $class_directory = dirname($reflector->getFileName());
        $namespace = $reflector->getNamespaceName();
        $commandClasses = array_filter(glob($class_directory . '/Command/*.php'));

        foreach ($commandClasses as $class_path) {
            $filename = str_replace($class_directory . '/Command/', '', $class_path);
            $class_name = str_replace('.php', '', $filename);
            $class = '\\' . $namespace . '\\Command\\' . $class_name;
            $command = $class::Instance();
            self::$commands[$command->env][$command->key] = $command;
        }
    }
}