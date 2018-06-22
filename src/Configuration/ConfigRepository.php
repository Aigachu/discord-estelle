<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Configuration;

use Doctrine\Common\Cache\ApcuCache;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigRepository
 * @package Aigachu\Lavenza\Configuration
 */
final class ConfigRepository
{
    /**
     * Fetch configuration data for a given scope.
     * Fetches all configuration scopes if a scope isn't specified.
     * A "Scope" here signifies a "category" for configuration. Each "Scope" is a separate directory housed in the 'config' folder
     * found at the root of this project.
     *
     * @TODO - Document and cleanup...Ugly long function!
     * @TODO - REFACTORING WARNING - LAVENZA DOES NOT APPRECIATE DIRTY CODE. FIX THIS.
     * @param String $scope
     * @return array
     */
    public static function config($scope = 'full'): array {

        // Initialize Cache
        $cache = new ApcuCache();
        $cache_key = "config::$scope";

        $configurations = $cache->fetch($cache_key);

        if ($configurations == null) {
            // First we get an array containing all the directories we need to parse.
            // If a scope is set, we will only go into the needed directory, instead of fetching all of the directories.
            if ($scope !== 'full') {
                $directories = [CONFIG_PATH . $scope];
            } else {
                $directories = array_filter(glob(CONFIG_PATH . '*'), 'is_dir');
            }

            $scopes = array_map(function($path) {
                return str_replace(CONFIG_PATH, '', $path);
            }, $directories);

            $configurations = [];

            foreach ($scopes as $key => $scope) {
                $config_files_path = CONFIG_PATH . "$scope/";
                $configuration_files = glob($config_files_path . '*');

                foreach ($configuration_files as $filepath) {
                    $config_key = str_replace($config_files_path, '', $filepath);
                    $config_key = str_replace('.config.yml', '', $config_key);

                    if ($config_key === 'example')
                        continue;

                    $configurations[$scope][$config_key] = Yaml::parse(file_get_contents($filepath));;
                }

            }

            if ($scope !== 'full') {
                $configurations = reset($configurations);
            }

            $cache->save($cache_key, $configurations);
        }

        return $configurations;
    }
}