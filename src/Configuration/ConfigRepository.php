<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Configuration;

use Aigachu\Lavenza\Model\Singleton\SingletonTrait;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigRepository
 *
 * @package Aigachu\Lavenza\Configuration
 */
final class ConfigRepository {

  use SingletonTrait;

  /**
   * Omitted configuration files.
   *
   * @var array
   */
  private static $omitted_configurations = ['example'];

  /**
   * Fetch configuration data for a given scope.
   * Fetches all configuration scopes if a scope isn't specified.
   * A "Scope" here signifies a "category" for configuration. Each "Scope" is
   * a separate directory housed in the 'config' folder found at the root of
   * this project.
   *
   * @param String $scope
   *
   * @return array
   */
  public static function config($scope = 'full') : array {
    // First we get an array containing all the directories we need to parse.
    // If a scope is set, we will only go into the needed directory, instead of fetching all of the directories.
    if ($scope !== 'full') {
      $configurations = self::fetchConfigFromDirectory(
        CONFIG_PATH . $scope . '/'
      );
    }
    else {
      $configurations = self::fetchAllConfigurations();
    }

    return $configurations;
  }

  /**
   * Fetches all of the configurations in the configuration folder of the
   * project.
   */
  private static function fetchAllConfigurations() : array {
    // Initialize array to hold the data.
    $configurations = [];

    // Fetch a list of directories from the configuration folder into an array.
    $directories = array_filter(glob(CONFIG_PATH . '*'), 'is_dir');

    // Loop in each folder and get the configurations
    foreach ($directories as $directory) {
      // Strip the full path of the folder and keep only name.
      // Add it to the $scope variable.
      $scope = str_replace(CONFIG_PATH, '', $directory);

      $configurations[$scope] = self::fetchConfigFromDirectory(
        $directory
      );

    }

    return $configurations;
  }

  /**
   * Fetch all configurations from a single directory.
   *
   * @param $directory
   *
   * @return array
   */
  private static function fetchConfigFromDirectory($directory) : array {

    // Array to house all configurations.
    $configurations = [];

    // List all files in this directory.
    $configuration_files = glob($directory . '*');

    // Loop into the configuration file paths found and fetch configurations.
    foreach ($configuration_files as $file_path) {
      // Clean and get the configuration key, which is the name of the file without the .config.yml.
      $config_key = str_replace(
        [$directory, '.config.yml'], '', $file_path
      );

      // Omit any "example" config files.
      if (\in_array($config_key, self::$omitted_configurations, FALSE)) {
        continue;
      }

      $configurations[$config_key] = Yaml::parse(
        file_get_contents($file_path)
      );
    }

    return $configurations;
  }
}
