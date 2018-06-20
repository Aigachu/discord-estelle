<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Configuration;

use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigRepository
 * @package Aigachu\Lavenza\Configuration
 */
final class ConfigRepository
{
    /**
     * Fetch configuration data for a given scope.
     * Fetches all configurations if a scope isn't specified.
     * A "Scope" here signifies a "category" for configuration. Each "Scope" is a separate directory housed in the 'config' folder
     * found at the root of this project.
     *
     * @TODO - Document and cleanup...Ugly long function!
     * @param null $scope
     * @return array
     */
    public static function config($scope = null): array {

        // If a namespace is set, we will only go into the needed folder in the 'config' directory.
        if (!is_null($scope)) {
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

        if (!is_null($scope)) {
            return reset($configurations);
        }

        return $configurations;
    }
}