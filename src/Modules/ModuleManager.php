<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Modules;

use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class ModuleManager
 *
 * @package Aigachu\Lavenza\Modules
 */
final class ModuleManager {

  use SingletonTrait;

  public static function load($module_name): void {
    $module_path = ROOT_PATH . '/modules/' . $module_name;

    if (file_exists($module_path . '/' . $module_name . '.module')) {
      include_once $module_path . '/' . $module_name . '.module';
    }
  }

}
