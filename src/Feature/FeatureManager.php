<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Feature;

use Aigachu\Lavenza\Lavenza;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class FeatureManager
 * Manages the loading and packaging of modules and their commands.
 *
 * @package Aigachu\Lavenza\Feature
 */
final class FeatureManager
{

    use SingletonTrait;

    /**
     * @var array $modules
     */
    private static $features;

    /**
     * @param $name
     *
     * @return mixed
     */
    public function load($name)
    {
        if (!isset(self::$features[$name])) {
            Lavenza::io('FAILED_FEATURE_LOAD', [$name]);

            return null;
        }

        return self::$features[$name];
    }

    /**
     * ModuleManager constructor.
     */
    private function __construct()
    {
        $this->loadFeatures();
    }

    /**
     * @return array
     */
    public static function getFeatures() : array
    {
        return self::$features;
    }

    /**
     * For each feature folder found in this folder, we load the features's
     * main class into the Manager.
     */
    private function loadFeatures() : void
    {
        $featureFolders = array_filter(glob(__DIR__.'/*'), 'is_dir');

        foreach ($featureFolders as $folder_path) {
            $feature_name = str_replace(__DIR__.'/', '', $folder_path);
            $class_name = $feature_name.'Feature';

            /** @var SingletonTrait $class */
            $class = '\\'.__NAMESPACE__.'\\'.$feature_name.'\\'.$class_name;
            $feature = $class::Instance();
            self::$features[$feature_name] = $feature;
        }
    }
}