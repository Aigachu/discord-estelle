<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Module;

use Aigachu\Lavenza\Lavenza;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class ModuleManager
 * Manages the loading and packaging of modules and their commands.
 * @package Aigachu\Lavenza\Module
 */
final class FeatureManager
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
        if (!isset(self::$modules[$name])) {
            Lavenza::io('FAILED_MODULE_LOAD', [$name]);
            return null;
        }
        return self::$modules[$name];
    }

    /**
     * ModuleManager constructor.
     */
    protected function __construct()
    {
        self::loadModules();
    }

    /**
     * @return array
     */
    public static function getModules(): array
    {
        return self::$modules;
    }

    /**
     * For each module folder found in this folder, we load the module's class into the Manager.
     */
    private function loadModules() {
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