<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Module;

use Aigachu\Lavenza\Singleton\SingletonTrait;

/**
 * Class ModuleManager
 * @package Aigachu\Lavenza\Module
 */
final class ModuleManager
{

    use SingletonTrait;

    /**
     * @var array $modules
     */
    protected static $modules;

    /**
     * @param $name
     * @return mixed
     */
    public function load($name) {
        return self::$modules[$name];
    }

    /**
     * ModuleManager constructor.
     */
    protected function __construct()
    {
        self::modules();
    }

    /**
     * @return array
     */
    public static function getModules(): array
    {
        return self::$modules;
    }

    /**
     * Oh boy.
     */
    private function modules() {
        $moduleFolders = array_filter(glob(__DIR__ . '/*'), 'is_dir');

        foreach ($moduleFolders as $folder_path) {
            $module_name = str_replace(__DIR__ . '/', '', $folder_path);
            $class_name = $module_name . 'Module';
            $class = '\\' . __NAMESPACE__ . '\\' . $module_name . '\\' . $class_name;
            $module = $class::Instance();
            self::$modules[$module_name] = $module;
        }
    }
}